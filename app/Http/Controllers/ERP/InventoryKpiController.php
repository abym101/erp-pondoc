<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Product;
class InventoryKpiController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_products'=>Product::count(),
            'low_stock'=>Product::whereColumn('stock','<=','minimum_stock')->count()
        ]);
    }
}
