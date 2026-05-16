<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWorkOrderRequest;
use App\Mail\ServiceReportMail;
use App\Models\Client;
use App\Models\Device;
use App\Models\User;
use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) {
            abort(403);
        }

        return view('work_orders.show', compact('workOrder'));
    }

    public function create()
    {
        $engineers = User::where('role', 'engineer')->get();
        $clients = Client::all();
        $devices = Device::all();

        return view('work_orders.create', compact('engineers', 'clients', 'devices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'device_id' => 'required|exists:devices,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_address' => 'required|string|max:255',
            'status' => 'required|in:pending,on_site,completed,cancelled',
            'cancellation_reason' => 'required_if:status,cancelled|nullable|string',
        ]);

        WorkOrder::create($validated);

        return redirect()->route('work-orders.index')->with('success', 'Orden creada exitosamente.');
    }

    public function edit(WorkOrder $workOrder)
    {
        // Protected by role:admin middleware in routes
        $engineers = User::where('role', 'engineer')->get();

        return view('work_orders.edit', compact('workOrder', 'engineers'));
    }

    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        // Protected by role:admin middleware in routes
        $workOrder->update($request->validated());

        return redirect()->route('work-orders.index')->with('success', 'Orden actualizada.');
    }

    public function updateStatus(Request $request, WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) {
            abort(403);
        }

        $allowedStatuses = ['pending', 'on_site', 'completed'];
        if (auth()->user()->isAdmin()) {
            $allowedStatuses[] = 'cancelled';
        }

        $validated = $request->validate([
            'status' => 'required|in:'.implode(',', $allowedStatuses),
            'cancellation_reason' => 'required_if:status,cancelled|nullable|string',
        ]);

        $workOrder->update($validated);

        return redirect()->route('work-orders.index')->with('success', 'Estado de la orden actualizado.');
    }

    public function generateReport(WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) {
            abort(403);
        }
        if ($workOrder->status !== 'completed') {
            abort(400, 'Solo se puede generar el reporte para órdenes completadas.');
        }

        // 1. Generate PDF
        $pdf = Pdf::loadView('pdf.service-report', compact('workOrder'));
        $fileName = 'reporte_'.$workOrder->id.'_'.time().'.pdf';
        $pdfPath = storage_path('app/public/'.$fileName);
        $pdf->save($pdfPath);

        // 2. Send Email
        Mail::to($workOrder->client->email)
            ->send(new ServiceReportMail($workOrder, $pdfPath));

        // 3. Simulate WhatsApp Notification
        Log::info('WHATSAPP NOTIFICATION (To Admin): El ingeniero '.auth()->user()->name.' ha cerrado la orden #'.$workOrder->id.' del cliente '.$workOrder->client->name.'. El reporte ha sido enviado al cliente.');

        return redirect()->route('work-orders.index')->with('success', 'Reporte generado, email enviado y administrador notificado.');
    }
}
