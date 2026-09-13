<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;

class AgingController extends Controller
{
    public function receivable()
    {
        $today = Carbon::today();
        $rows = Sale::where(
            'payment_status',
            'UNPAID'
        )->get()->map(function ($x) use ($today) {
            $due =
            $x->due_date
            ? Carbon::parse($x->due_date)
            : Carbon::parse($x->posting_date);
            $days =
            max(
                0,
                $today->diffInDays(
                    $due,
                    false
                ) * -1
            );

            return [
                'invoice_no' => $x->invoice_no,
                'customer_id' => $x->customer_id,
                'balance' => $x->grand_total - $x->paid_amount,
                'days' => $days,
            ];
        });

        return response()->json($rows);
    }

    public function payable()
    {
        $today = Carbon::today();
        $rows = Purchase::where(
            'payment_status',
            'UNPAID'
        )->get()->map(function ($x) use ($today) {
            $due =
            $x->due_date
            ? Carbon::parse($x->due_date)
            : Carbon::parse($x->posting_date);
            $days =
            max(
                0,
                $today->diffInDays(
                    $due,
                    false
                ) * -1
            );

            return [
                'invoice_no' => $x->invoice_no,
                'supplier_id' => $x->supplier_id,
                'balance' => $x->grand_total - $x->paid_amount,
                'days' => $days,
            ];
        });

        return response()->json($rows);
    }
}
