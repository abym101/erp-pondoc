<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Product;
use App\Models\Sale;
use App\Models\WorkOrder;

class DashboardUiController extends Controller
{
    public function index()
    {
        $cashIn =
            CashTransaction::where(
                'type',
                'IN'
            )->sum('amount');
        $cashOut =
            CashTransaction::where(
                'type',
                'OUT'
            )->sum('amount');

        return view(
            'erp.dashboard-v2',
            [
                'products' => Product::count(),
                'sales' => Sale::count(),
                'workOrders' => WorkOrder::count(),
                'cash' => $cashIn - $cashOut,
            ]
        );
    }
}
