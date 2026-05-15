<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Device;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $stats = [
                'is_admin' => true,
                'clients_count' => Client::count(),
                'devices_count' => Device::count(),
                'pending_orders_count' => WorkOrder::where('status', 'pending')->count(),
                'total_orders_count' => WorkOrder::count(),
                'orders_by_status' => [
                    'pending' => WorkOrder::where('status', 'pending')->count(),
                    'on_site' => WorkOrder::where('status', 'on_site')->count(),
                    'completed' => WorkOrder::where('status', 'completed')->count(),
                    'cancelled' => WorkOrder::where('status', 'cancelled')->count(),
                ],
                'recent_activity' => WorkOrder::with(['client', 'engineer'])->orderBy('id', 'desc')->take(5)->get(),
            ];
        } else {
            $stats = [
                'is_admin' => false,
                'pending_orders_count' => WorkOrder::where('user_id', $user->id)->where('status', 'pending')->count(),
                'completed_orders_count' => WorkOrder::where('user_id', $user->id)->where('status', 'completed')->count(),
                'total_orders_count' => WorkOrder::where('user_id', $user->id)->count(),
                'active_orders' => WorkOrder::where('user_id', $user->id)->whereIn('status', ['pending', 'on_site'])->with('client', 'device')->orderBy('id', 'desc')->get(),
            ];
        }

        return view('dashboard', compact('stats'));
    }

    public function weeklyReport()
    {
        return $this->generateGlobalReport('Semanales', now()->subDays(7));
    }

    public function monthlyReport()
    {
        return $this->generateGlobalReport('Mensuales', now()->subMonth());
    }

    public function yearlyReport()
    {
        return $this->generateGlobalReport('Anuales', now()->subYear());
    }

    private function generateGlobalReport($period, $since)
    {
        $workOrders = WorkOrder::where('created_at', '>=', $since)->with(['client', 'device', 'engineer'])->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.global-report', compact('workOrders', 'period'));
        return $pdf->download("Reporte_Ejecutivo_{$period}.pdf");
    }
}
