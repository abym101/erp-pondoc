<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Sale;
class SalesKpiController extends Controller
{
    public function index()
    {
        return response()->json([
            'sales_count'=>Sale::count(),
            'sales_total'=>Sale::sum('total')
        ]);
    }
}
