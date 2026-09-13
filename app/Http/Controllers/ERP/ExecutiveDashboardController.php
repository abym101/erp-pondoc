<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\WorkOrder;

class ExecutiveDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'products' => Product::count(),
            'customers' => Customer::count(),
            'suppliers' => Supplier::count(),
            'sales_count' => Sale::count(),
            'purchase_count' => Purchase::count(),
            'work_orders' => WorkOrder::count(),
            'sales_total' => Sale::sum(
                'grand_total'
            ),
            'purchase_total' => Purchase::sum(
                'grand_total'
            ),
            'cash_balance' => CashTransaction::where(
                'type',
                'IN'
            )->sum(
                'amount'
            )
                -
                CashTransaction::where(
                    'type',
                    'OUT'
                )->sum(
                    'amount'
                ),
            'stock_total' => Product::sum(
                'stock'
            ),
        ]);
    }
}
