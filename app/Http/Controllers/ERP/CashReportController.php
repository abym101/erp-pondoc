<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;

class CashReportController extends Controller
{
    public function index()
    {
        $in =
            CashTransaction::where(
                'type',
                'IN'
            )->sum(
                'amount'
            );
        $out =
            CashTransaction::where(
                'type',
                'OUT'
            )->sum(
                'amount'
            );

        return response()->json([
            'cash_in' => $in,
            'cash_out' => $out,
            'balance' => $in - $out,
            'detail' => CashTransaction::latest()
                ->get(),
        ]);
    }
}
