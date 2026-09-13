<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Purchase;

class AccountsPayableController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_hutang' => Purchase::where(
                'payment_status',
                'UNPAID'
            )->sum(
                'grand_total'
            ),
            'detail' => Purchase::where(
                'payment_status',
                'UNPAID'
            )
                ->with(
                    'supplier'
                )
                ->latest()
                ->get(),
        ]);
    }
}
