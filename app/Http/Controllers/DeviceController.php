<?php
namespace App\Http\Controllers;

use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('client')->latest()->get();
        return view('devices.index', compact('devices'));
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->back()->with('success', 'Equipo movido a la papelera (Soft Delete).');
    }
}
