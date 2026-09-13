<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InventoryValuationController extends Controller
{
    public function index()
    {
        $layers =
        DB::table('inventory_layers')
            ->where('qty_remaining', '>', 0)
            ->orderBy('product_id')
            ->orderBy('id')
            ->get();
        $inventoryValue = 0;
        foreach ($layers as $layer) {
            $inventoryValue +=
                $layer->qty_remaining
                *
                $layer->unit_cost;
        }

        return response()->json([
            'stock_qty' => $layers->sum(
                'qty_remaining'
            ),
            'inventory_value' => $inventoryValue,
            'layers' => $layers,
        ]);
    }
}
