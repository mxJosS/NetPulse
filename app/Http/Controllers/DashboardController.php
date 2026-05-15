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
            ];
        } else {
            $stats = [
                'is_admin' => false,
                'pending_orders_count' => WorkOrder::where('user_id', $user->id)->where('status', 'pending')->count(),
                'completed_orders_count' => WorkOrder::where('user_id', $user->id)->where('status', 'completed')->count(),
                'total_orders_count' => WorkOrder::where('user_id', $user->id)->count(),
            ];
        }

        return view('dashboard', compact('stats'));
    }
}
