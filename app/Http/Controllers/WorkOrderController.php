<?php
namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Http\Requests\UpdateWorkOrderRequest;

class WorkOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $workOrders = $user->isAdmin() 
            ? WorkOrder::with(['client', 'device', 'engineer'])->orderBy('id', 'desc')->get()
            : WorkOrder::where('user_id', $user->id)->with(['client', 'device'])->orderBy('id', 'desc')->get();

        return view('work_orders.index', compact('workOrders'));
    }

    public function show(WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) abort(403);
        return view('work_orders.show', compact('workOrder'));
    }

    public function create()
    {
        $engineers = \App\Models\User::where('role', 'engineer')->get();
        $clients = \App\Models\Client::all();
        $devices = \App\Models\Device::all();
        return view('work_orders.create', compact('engineers', 'clients', 'devices'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'device_id' => 'required|exists:devices,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_address' => 'required|string|max:255',
            'status' => 'required|in:pending,on_site,completed',
        ]);

        WorkOrder::create($validated);
        return redirect()->route('work-orders.index')->with('success', 'Orden creada exitosamente.');
    }

    public function edit(WorkOrder $workOrder)
    {
        // Protected by role:admin middleware in routes
        $engineers = \App\Models\User::where('role', 'engineer')->get();
        return view('work_orders.edit', compact('workOrder', 'engineers'));
    }

    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        // Protected by role:admin middleware in routes
        $workOrder->update($request->validated());
        return redirect()->route('work-orders.index')->with('success', 'Orden actualizada.');
    }

    public function updateStatus(\Illuminate\Http\Request $request, WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) abort(403);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,on_site,completed',
        ]);

        $workOrder->update(['status' => $validated['status']]);
        return redirect()->route('work-orders.index')->with('success', 'Estado de la orden actualizado.');
    }

    public function generateReport(WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) abort(403);
        if ($workOrder->status !== 'completed') abort(400, 'Solo se puede generar el reporte para órdenes completadas.');

        // 1. Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.service-report', compact('workOrder'));
        $fileName = 'reporte_' . $workOrder->id . '_' . time() . '.pdf';
        $pdfPath = storage_path('app/public/' . $fileName);
        $pdf->save($pdfPath);

        // 2. Send Email
        \Illuminate\Support\Facades\Mail::to($workOrder->client->email)
            ->send(new \App\Mail\ServiceReportMail($workOrder, $pdfPath));

        // 3. Simulate WhatsApp Notification
        \Illuminate\Support\Facades\Log::info("WHATSAPP NOTIFICATION (To Admin): El ingeniero " . auth()->user()->name . " ha cerrado la orden #" . $workOrder->id . " del cliente " . $workOrder->client->name . ". El reporte ha sido enviado al cliente.");

        return redirect()->route('work-orders.index')->with('success', 'Reporte generado, email enviado y administrador notificado.');
    }
}
