<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Sale;

class AccountsReceivableController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_piutang' => Sale::where(
                'payment_status',
                'UNPAID'
            )->sum(
                'grand_total'
            ),
            'detail' => Sale::where(
                'payment_status',
                'UNPAID'
            )
                ->with(
                    'customer'
                )
                ->latest()
                ->get(),
        ]);
    }
}
