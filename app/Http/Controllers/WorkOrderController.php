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
            ? WorkOrder::with(['client', 'device', 'engineer'])->latest()->get()
            : WorkOrder::where('user_id', $user->id)->with(['client', 'device'])->latest()->get();

        return view('work_orders.index', compact('workOrders'));
    }

    public function edit(WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) abort(403);
        return view('work_orders.edit', compact('workOrder'));
    }

    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        if (auth()->user()->isEngineer() && $workOrder->user_id !== auth()->id()) abort(403);
        $workOrder->update($request->validated());
        return redirect()->route('work-orders.index')->with('success', 'Orden actualizada.');
    }
}
