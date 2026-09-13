<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\WorkOrder;

class VehicleHistoryController extends Controller
{
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $history = WorkOrder::where(
            'vehicle_id',
            $vehicle->id
        )
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'vehicle' => $vehicle,
            'history' => $history,
        ]);
    }
}
