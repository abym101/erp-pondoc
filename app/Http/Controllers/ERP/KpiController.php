<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Supplier;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;

class KpiController extends Controller
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

        return response()->json([
            'products' => Product::count(),
            'stock_total' => Product::sum('stock'),
            'suppliers' => Supplier::count(),
            'sales_count' => Sale::count(),
            'sales_total' => Sale::sum('grand_total'),
            'purchase_count' => Purchase::count(),
            'purchase_total' => Purchase::sum('grand_total'),
            'work_orders' => WorkOrder::count(),
            'today_sales' => Sale::whereDate(
                'created_at',
                today()
            )->sum('grand_total'),
            'today_work_orders' => WorkOrder::whereDate(
                'created_at',
                today()
            )->count(),
            'cash_in' => $cashIn,
            'cash_out' => $cashOut,
            'cash_balance' => $cashIn - $cashOut,
            'low_stock' => Product::where(
                'stock',
                '<=',
                10
            )
                ->orderBy('stock')
                ->get(),
            'top_products' => SaleItem::select(
                'product_id',
                DB::raw(
                    'SUM(qty) total_qty'
                )
            )
                ->with('product')
                ->groupBy(
                    'product_id'
                )
                ->orderByDesc(
                    'total_qty'
                )
                ->limit(10)
                ->get(),
        ]);
    }
}
