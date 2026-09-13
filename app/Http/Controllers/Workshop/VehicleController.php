<?php
namespace App\Http\Controllers\Workshop;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
class VehicleController extends Controller
{
    public function index()
    {
        return view(
            'vehicles.index',
            [
                'vehicles'=>Vehicle::latest()->get()
            ]
        );
    }
}
