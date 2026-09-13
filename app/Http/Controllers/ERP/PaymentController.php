<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Payment;
use App\Models\Sale;
use App\Services\PeriodLockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(
        Request $request
    ) {
        $data = $request->validate([
            'sale_id' => 'required|integer',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|string',
            'posting_date' => 'nullable|date',
        ]);
        $postingDate =
            $data['posting_date']
            ?? now()->toDateString();
        PeriodLockService::validate(
            $postingDate
        );
        DB::transaction(
            function () use (
                $data,
                $postingDate
            ) {
                $sale =
                Sale::findOrFail(
                    $data['sale_id']
                );
                Payment::create([
                    'sale_id' => $sale->id,
                    'posting_date' => $postingDate,
                    'amount' => $data['amount'],
                    'method' => $data['method'],
                ]);
                Sale::$allowUpdate = true;
                $sale->paid_amount =
                    (
                        $sale->paid_amount ?? 0
                    )
                    +
                    $data['amount'];
                if (
                    $sale->paid_amount
                    >=
                    $sale->grand_total
                ) {
                    $sale->payment_status = 'PAID';
                }
                $sale->save();
                Sale::$allowUpdate = false;
                $cash =
                Account::where(
                    'code',
                    '1000'
                )->firstOrFail();
                $ar =
                Account::where(
                    'code',
                    '1200'
                )->firstOrFail();
                JournalEntry::create([
                    'account_id' => $cash->id,
                    'posting_date' => $postingDate,
                    'debit' => $data['amount'],
                    'credit' => 0,
                    'description' => 'PAYMENT '.$sale->invoice_no,
                ]);
                JournalEntry::create([
                    'account_id' => $ar->id,
                    'posting_date' => $postingDate,
                    'debit' => 0,
                    'credit' => $data['amount'],
                    'description' => 'PAYMENT '.$sale->invoice_no,
                ]);
            }
        );

        return [
            'success' => true,
        ];
    }
}
