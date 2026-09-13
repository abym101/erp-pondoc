<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Sale;

class SalesReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'count' => Sale::count(),
            'total' => Sale::sum(
                'grand_total'
            ),
            'detail' => Sale::with(
                'customer'
            )
                ->latest()
                ->get(),
        ]);
    }
}
