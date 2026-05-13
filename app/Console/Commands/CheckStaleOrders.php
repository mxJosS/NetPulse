<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WorkOrder;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CheckStaleOrders extends Command
{
    protected $signature = 'noclite:check-stale';
    protected $description = 'Alerta al Admin de órdenes pendientes por más de 48 hrs';

    public function handle()
    {
        $count = WorkOrder::where('status', 'pending')
                    ->where('created_at', '<', now()->subHours(48))->count();

        if ($count > 0) {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                Mail::raw("URGENTE: Tienes {$count} orden(es) de trabajo con más de 48 horas sin atención.", function ($m) use ($admin) {
                    $m->to($admin->email)->subject('🚨 Alerta NOC: SLA Incumplido');
                });
                $this->info("Alerta enviada. Órdenes rezagadas: {$count}");
            }
        } else {
            $this->info("Todo al día. No hay órdenes rezagadas.");
        }
    }
}
