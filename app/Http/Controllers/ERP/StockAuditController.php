<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;

class StockAuditController extends Controller
{
    public function index()
    {
        return response()->json([
            'products' => Product::count(),
            'total_stock' => Product::sum(
                'stock'
            ),
            'movements' => StockMovement::count(),
            'low_stock' => Product::where(
                'stock',
                '<=',
                10
            )
                ->orderBy(
                    'stock'
                )
                ->get(),
        ]);
    }
}
