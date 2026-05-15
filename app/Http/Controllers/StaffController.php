<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role', 'engineer')->latest()->get();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'engineer',
        ]);

        return redirect()->route('staff.index')->with('success', 'Ingeniero registrado exitosamente.');
    }

    public function edit(User $staff)
    {
        if ($staff->role !== 'engineer') abort(404);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, User $staff)
    {
        if ($staff->role !== 'engineer') abort(404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $staff->id],
        ]);

        $staff->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => ['required', Password::defaults()]]);
            $staff->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('staff.index')->with('success', 'Ingeniero actualizado exitosamente.');
    }

    public function destroy(User $staff)
    {
        if ($staff->role !== 'engineer') abort(404);
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Ingeniero eliminado.');
    }
}
