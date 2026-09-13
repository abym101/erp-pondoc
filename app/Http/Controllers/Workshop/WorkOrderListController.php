<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;

class WorkOrderListController extends Controller
{
    public function index()
    {
        return WorkOrder::with([
            'customer',
            'vehicle',
        ])
            ->latest()
            ->get();
    }
}
