<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Device;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@netpulse.test'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Engineer
        $engineer = User::firstOrCreate(
            ['email' => 'engineer@netpulse.test'],
            [
                'name' => 'Engineer User',
                'password' => Hash::make('password'),
                'role' => 'engineer',
            ]
        );

        // Create Clients
        $client1 = Client::create([
            'name' => 'Corporativo ACME',
            'email' => 'contacto@acme.com',
            'phone' => '555-0101',
            'address' => 'Av. Siempre Viva 123',
        ]);

        $client2 = Client::create([
            'name' => 'Tech Solutions SA',
            'email' => 'soporte@techsol.com',
            'phone' => '555-0202',
            'address' => 'Calle Falsa 456',
        ]);

        // Create Devices
        $device1 = Device::create([
            'client_id' => $client1->id,
            'brand' => 'Cisco',
            'model' => 'ISR 4331',
            'serial_number' => 'SN123456789',
            'ip_address' => '192.168.1.1',
        ]);

        $device2 = Device::create([
            'client_id' => $client2->id,
            'brand' => 'MikroTik',
            'model' => 'CCR2004',
            'serial_number' => 'SN987654321',
            'ip_address' => '10.0.0.1',
        ]);

        // Create Work Orders
        WorkOrder::create([
            'client_id' => $client1->id,
            'device_id' => $device1->id,
            'user_id' => $engineer->id,
            'title' => 'Mantenimiento Preventivo',
            'description' => 'Limpieza de logs y actualización de firmware.',
            'status' => 'pending',
        ]);

        WorkOrder::create([
            'client_id' => $client2->id,
            'device_id' => $device2->id,
            'user_id' => $engineer->id,
            'title' => 'Falla de Conectividad',
            'description' => 'El enlace principal está caído.',
            'status' => 'on_site',
        ]);
    }
}
