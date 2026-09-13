<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\WorkOrder;

class BusinessDashboardController extends Controller
{
    public function index()
    {
        $sales =
            Sale::sum(
                'grand_total'
            );
        $purchase =
            Purchase::sum(
                'grand_total'
            );
        $hpp =
            PurchaseItem::sum(
                'subtotal'
            );
        $omzet =
            SaleItem::sum(
                'subtotal'
            );
        $cashIn =
            CashTransaction::where(
                'type',
                'IN'
            )->sum(
                'amount'
            );
        $cashOut =
            CashTransaction::where(
                'type',
                'OUT'
            )->sum(
                'amount'
            );

        return response()->json([
            'products' => Product::count(),
            'work_orders' => WorkOrder::count(),
            'sales_count' => Sale::count(),
            'purchase_count' => Purchase::count(),
            'omzet' => $omzet,
            'hpp' => $hpp,
            'gross_profit' => $omzet - $hpp,
            'cash_balance' => $cashIn - $cashOut,
            'inventory_qty' => Product::sum(
                'stock'
            ),
        ]);
    }
}
