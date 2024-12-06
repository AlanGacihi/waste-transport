<?php

namespace App\Http\Controllers\API;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::with('service')->get());
    }

    public function show($id)
    {
        $calendar = Calendar::with('service')->find($id);

        if (!$calendar) {
            return response()->json(['message' => 'Calendar entry not found'], 404);
        }

        return response()->json($calendar);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sdate' => 'required|date',
            'servid' => 'required|integer|exists:services,id',
        ]);

        $calendar = Calendar::create($validated);

        return response()->json($calendar, 201);
    }

    public function update(Request $request, $id)
    {
        $calendar = Calendar::find($id);

        if (!$calendar) {
            return response()->json(['message' => 'Calendar entry not found'], 404);
        }

        $validated = $request->validate([
            'sdate' => 'sometimes|date',
            'servid' => 'sometimes|integer|exists:services,id',
        ]);

        $calendar->update($validated);

        return response()->json($calendar);
    }

    public function destroy($id)
    {
        $calendar = Calendar::find($id);

        if (!$calendar) {
            return response()->json(['message' => 'Calendar entry not found'], 404);
        }

        $calendar->delete();

        return response()->json(['message' => 'Calendar entry deleted']);
    }
}
