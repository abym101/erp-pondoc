<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Product;

class LowStockController extends Controller
{
    public function index()
    {
        return Product::where(
            'stock',
            '<=',
            10
        )
            ->orderBy(
                'stock'
            )
            ->get();
    }
}
