<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;

class FinanceController extends Controller
{
    public function index()
    {
        $cashIn =
            CashTransaction::where(
                'type',
                'IN'
            )->sum('amount');
        $cashOut =
            CashTransaction::where(
                'type',
                'OUT'
            )->sum('amount');

        return response()->json([
            'cash_in' => $cashIn,
            'cash_out' => $cashOut,
            'balance' => $cashIn - $cashOut,
        ]);
    }
}
