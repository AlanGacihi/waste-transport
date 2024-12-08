<?php

namespace App\Http\Controllers;

use App\Models\ResDem;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ResDemController extends Controller
{

    public function index()
    {
        $resdems = ResDem::with('service')
            ->where('user_id', Auth::user()->id)
            ->orderBy('demand', 'desc')
            ->get();
        $services = Service::all();

        return view('dashboard.index', compact('resdems', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servid' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'demand' => 'required|date|after:yesterday',
        ]);

        ResDem::create([
            'user_id' => Auth::user()->id,
            'servid' => $request->servid,
            'quantity' => $request->quantity,
            'demand' => $request->demand,
        ]);

        return redirect()->route('dashboard')->with('success', 'Request created successfully');
    }

    public function destroy(ResDem $resdem)
    {
        if ($resdem->user_id !== Auth::user()->id) {
            abort(403);
        }

        $resdem->delete();
        return redirect()->route('dashboard')->with('success', 'Request deleted successfully');
    }
}
