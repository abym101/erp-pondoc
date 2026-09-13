<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\WorkOrder;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'customers' => Customer::count(),
            'vehicles' => Vehicle::count(),
            'work_orders' => WorkOrder::count(),
            'total_value' => WorkOrder::sum(
                'total'
            ),
        ]);
    }
}
