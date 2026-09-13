<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Purchase;

class PurchaseReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'count' => Purchase::count(),
            'total' => Purchase::sum(
                'grand_total'
            ),
            'detail' => Purchase::with(
                'supplier'
            )
                ->latest()
                ->get(),
        ]);
    }
}
