<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Product;

class StockReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_stock' => Product::sum(
                'stock'
            ),
            'products' => Product::orderBy(
                'name'
            )->get(),
        ]);
    }
}
