<?php

namespace App\Http\Controllers;

use App\Models\ResDem;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index', ['services' => Service::all()]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wtype' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Service::create($validated);
        return redirect()->route('admin.index')
            ->with('success', 'Service created successfully');
    }

    public function show(Service $service)
    {
        return response()->json($service);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'wtype' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $service->update($validated);
        return redirect()->route('admin.index')
            ->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Service deleted successfully');
    }
}
