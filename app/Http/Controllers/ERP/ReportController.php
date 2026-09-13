<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'products' => Product::count(),
            'sales_count' => Sale::count(),
            'sales_total' => Sale::sum('grand_total'),
            'work_orders_count' => WorkOrder::count(),
            'work_orders_total' => WorkOrder::sum('total'),
            'stock_value' => Product::sum(
                DB::raw(
                    'stock * purchase_price'
                )
            ),
        ]);
    }

    public function sales()
    {
        return response()->json([
            'transactions' => Sale::count(),
            'revenue' => Sale::sum(
                'grand_total'
            ),
            'items_sold' => SaleItem::sum(
                'qty'
            ),
            'top_products' => SaleItem::select(
                'product_id',
                DB::raw(
                    'SUM(qty) as total_qty'
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

    public function workOrders()
    {
        return response()->json([
            'total_work_orders' => WorkOrder::count(),
            'total_revenue' => WorkOrder::sum(
                'total'
            ),
            'avg_ticket' => (
                WorkOrder::count() > 0
            )
                ?
                (
                    WorkOrder::sum('total')
                    /
                    WorkOrder::count()
                )
                :
                0,
            'latest' => WorkOrder::latest()
                ->limit(20)
                ->get(),
        ]);
    }

    public function stock()
    {
        return Product::select(
            'id',
            'sku',
            'name',
            'stock',
            'purchase_price',
            'selling_price'
        )
            ->orderBy('name')
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'sku' => $p->sku,
                    'name' => $p->name,
                    'stock' => $p->stock,
                    'purchase_price' => $p->purchase_price,
                    'selling_price' => $p->selling_price,
                    'stock_value' => $p->stock
                        *
                        $p->purchase_price,
                ];
            });
    }
}
