<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\WorkOrder;

class HealthCheckController extends Controller
{
    public function index()
    {
        return [
            'products' => Product::count(),
            'suppliers' => Supplier::count(),
            'purchases' => Purchase::count(),
            'sales' => Sale::count(),
            'work_orders' => WorkOrder::count(),
            'cash_tx' => CashTransaction::count(),
            'status' => 'OK',
        ];
    }
}
