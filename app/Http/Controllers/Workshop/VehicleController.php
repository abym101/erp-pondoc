<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return Vehicle::latest()->get();
    }

    public function store(
        Request $request
    ) {
        return Vehicle::create([
            'customer_id' => $request->customer_id,
            'plate_no' => $request->plate_no,
            'brand' => $request->brand,
            'model' => $request->model,
        ]);
    }
}
