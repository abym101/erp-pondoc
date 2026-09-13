<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;

class CashflowController extends Controller
{
    public function index()
    {
        $in =
            CashTransaction::where(
                'type',
                'IN'
            )->sum('amount');
        $out =
            CashTransaction::where(
                'type',
                'OUT'
            )->sum('amount');

        return response()->json([
            'cash_in' => $in,
            'cash_out' => $out,
            'balance' => $in - $out,
        ]);
    }
}
