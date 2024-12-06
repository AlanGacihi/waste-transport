<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Service;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request, $servid = null)
    {
        $query = Calendar::with('service');
        $service = null;

        if ($servid) {
            $query->where('servid', (int) $servid);
            $service = Service::find((int) $servid);
        }

        $calendar = $query->orderBy('sdate', 'asc')->get();
        $services = Service::all();

        return view('calendar.index', compact('calendar', 'services', 'service'));
    }
}
