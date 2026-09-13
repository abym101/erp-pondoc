<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use App\Models\Purchase;
use App\Models\Sale;

class ProfitLossController extends Controller
{
    public function index()
    {
        $sales =
            Sale::sum(
                'grand_total'
            );
        $purchase =
            Purchase::sum(
                'grand_total'
            );
        $expense =
            CashTransaction::where(
                'type',
                'OUT'
            )->sum(
                'amount'
            );

        return response()->json([
            'sales' => $sales,
            'purchase' => $purchase,
            'expense' => $expense,
            'profit' => $sales - $purchase - $expense,
        ]);
    }
}
