<?php

namespace App\Services;

use App\Models\Service;
use App\Models\Calendar;
use App\Models\ResDem;

class SOAPService
{
    /**
     * Service Operations
     */
    public function getServices()
    {
        return Service::all()->toArray();
    }

    public function getService($id)
    {
        return Service::with(['calendars', 'resdems'])->findOrFail($id)->toArray();
    }

    public function createService($wtype, $description)
    {
        return Service::create([
            'wtype' => $wtype,
            'description' => $description,
        ])->toArray();
    }

    public function updateService($id, $wtype, $description)
    {
        $service = Service::findOrFail($id);
        $service->update([
            'wtype' => $wtype,
            'description' => $description,
        ]);
        return $service->toArray();
    }

    public function deleteService($id)
    {
        return Service::findOrFail($id)->delete();
    }

    /**
     * Calendar Operations
     */
    public function getCalendars()
    {
        return Calendar::with('service')->get()->toArray();
    }

    public function getCalendar($id)
    {
        return Calendar::with('service')->findOrFail($id)->toArray();
    }

    public function createCalendar($sdate, $servid)
    {
        return Calendar::create([
            'sdate' => $sdate,
            'servid' => $servid,
        ])->toArray();
    }

    public function updateCalendar($id, $sdate, $servid)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->update([
            'sdate' => $sdate,
            'servid' => $servid,
        ]);
        return $calendar->toArray();
    }

    public function deleteCalendar($id)
    {
        return Calendar::findOrFail($id)->delete();
    }

    /**
     * ResDem Operations
     */
    public function getResDems()
    {
        return ResDem::with(['service', 'user'])->get()->toArray();
    }

    public function getResDem($id)
    {
        return ResDem::with(['service', 'user'])->findOrFail($id)->toArray();
    }

    public function createResDem($user_id, $demand, $servid, $quantity)
    {
        return ResDem::create([
            'user_id' => $user_id,
            'demand' => $demand,
            'servid' => $servid,
            'quantity' => $quantity,
        ])->toArray();
    }

    public function updateResDem($id, $user_id, $demand, $servid, $quantity)
    {
        $resDem = ResDem::findOrFail($id);
        $resDem->update([
            'user_id' => $user_id,
            'demand' => $demand,
            'servid' => $servid,
            'quantity' => $quantity,
        ]);
        return $resDem->toArray();
    }

    public function deleteResDem($id)
    {
        return ResDem::findOrFail($id)->delete();
    }
}
