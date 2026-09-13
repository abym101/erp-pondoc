<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function index()
    {
        return view(
            'workorders.index',
            [
                'customers' => Customer::orderBy('name')->get(),
                'vehicles' => Vehicle::orderByDesc('id')->get(),
                'workorders' => WorkOrder::orderByDesc('id')->get(),
                'products' => Product::orderBy('name')->get(),
            ]
        );
    }

    public function store(Request $request)
    {
        $serviceCost =
            (float) ($request->service_cost ?? 0);
        WorkOrder::create([
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'number' => 'WO-'.date('YmdHis'),
            'status' => 'OPEN',
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
            'service_cost' => $serviceCost,
            'sparepart_cost' => 0,
            'total' => $serviceCost,
        ]);

        return redirect('/erp/work-orders');
    }
}
