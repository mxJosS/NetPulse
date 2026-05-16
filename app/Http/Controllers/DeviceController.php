<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('client')->latest()->get();

        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $clients = Client::all();

        return view('devices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:devices,serial_number',
            'ip_address' => 'nullable|ip',
        ]);

        Device::create($validated);

        return redirect()->route('devices.index')->with('success', 'Equipo registrado con éxito.');
    }

    public function edit(Device $device)
    {
        $clients = Client::all();

        return view('devices.edit', compact('device', 'clients'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:devices,serial_number,'.$device->id,
            'ip_address' => 'nullable|ip',
        ]);

        $device->update($validated);

        return redirect()->route('devices.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->back()->with('success', 'Equipo eliminado con éxito.');
    }
}
