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
        $stats = [
            'clients_count' => Client::count(),
            'devices_count' => Device::count(),
            'pending_orders_count' => WorkOrder::where('status', 'pending')->count(),
            'total_orders_count' => WorkOrder::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
