<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;

class StockLedgerController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_products' => Product::count(),
            'total_stock' => Product::sum(
                'stock'
            ),
            'movements' => StockMovement::with(
                'product'
            )
                ->latest()
                ->limit(500)
                ->get(),
        ]);
    }
}
