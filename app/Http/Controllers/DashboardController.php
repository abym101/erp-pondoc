<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\WorkOrder;

class DashboardController extends Controller
{
    public function index()
    {
        return [
            'products' => Product::count(),
            'customers' => Customer::count(),
            'sales' => Sale::count(),
            'workorders' => WorkOrder::count(),
            'revenue' => Sale::sum('grand_total'),
            'low_stock' => Product::where(
                'stock',
                '<=',
                5
            )->count(),
            'active_workorders' => WorkOrder::where(
                'status',
                'OPEN'
            )->count(),
        ];
    }
}
