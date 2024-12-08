<?php

namespace App\Http\Controllers\API;

use App\Models\ResDem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResdemController extends Controller
{
    public function index()
    {
        return response()->json(ResDem::with('service')->get());
    }

    public function show($id)
    {
        $resdem = ResDem::with(['service', 'user'])->find($id);

        if (!$resdem) {
            return response()->json(['message' => 'ResDem entry not found'], 404);
        }

        return response()->json($resdem);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'demand' => 'required|date',
            'servid' => 'required|integer|exists:services,id',
            'quantity' => 'required|integer',
        ]);

        $resdem = ResDem::create($validated);

        return response()->json($resdem, 201);
    }

    public function update(Request $request, $id)
    {
        $resdem = ResDem::find($id);

        if (!$resdem) {
            return response()->json(['message' => 'ResDem entry not found'], 404);
        }

        $validated = $request->validate([
            'demand' => 'sometimes|date',
            'servid' => 'sometimes|integer|exists:services,id',
            'quantity' => 'sometimes|integer',
        ]);

        $resdem->update($validated);

        return response()->json($resdem);
    }

    public function destroy($id)
    {
        $resdem = ResDem::find($id);

        if (!$resdem) {
            return response()->json(['message' => 'ResDem entry not found'], 404);
        }

        $resdem->delete();

        return response()->json(['message' => 'ResDem entry deleted']);
    }
}
