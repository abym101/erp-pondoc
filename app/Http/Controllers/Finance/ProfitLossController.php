<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;

class ProfitLossController extends Controller
{
    public function index()
    {
        $revenue =
            Sale::sum(
                'grand_total'
            );
        $cost =
            Purchase::sum(
                'grand_total'
            );

        return response()->json([
            'revenue' => $revenue,
            'cost' => $cost,
            'profit' => $revenue - $cost,
        ]);
    }
}
