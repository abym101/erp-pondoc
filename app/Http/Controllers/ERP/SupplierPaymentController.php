<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Purchase;
use App\Models\SupplierPayment;
use App\Services\PeriodLockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierPaymentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_id' => 'required|integer',
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
                $purchase =
                Purchase::findOrFail(
                    $data['purchase_id']
                );
                SupplierPayment::create([
                    'purchase_id' => $purchase->id,
                    'posting_date' => $postingDate,
                    'amount' => $data['amount'],
                    'method' => $data['method'],
                ]);
                Purchase::withoutEvents(
                    function () use (
                        $purchase,
                        $data
                    ) {
                        $purchase->paid_amount =
                            ($purchase->paid_amount ?? 0)
                            +
                            $data['amount'];
                        if (
                            $purchase->paid_amount
                            >=
                            $purchase->grand_total
                        ) {
                            $purchase->payment_status =
                                'PAID';
                        }
                        $purchase->save();
                    }
                );
                $ap =
                Account::where(
                    'code',
                    '2100'
                )->firstOrFail();
                $cash =
                Account::where(
                    'code',
                    '1000'
                )->firstOrFail();
                JournalEntry::create([
                    'account_id' => $ap->id,
                    'posting_date' => $postingDate,
                    'debit' => $data['amount'],
                    'credit' => 0,
                    'description' => 'SUPPLIER PAYMENT '.
                        $purchase->invoice_no,
                ]);
                JournalEntry::create([
                    'account_id' => $cash->id,
                    'posting_date' => $postingDate,
                    'debit' => 0,
                    'credit' => $data['amount'],
                    'description' => 'SUPPLIER PAYMENT '.
                        $purchase->invoice_no,
                ]);
            }
        );

        return response()->json([
            'success' => true,
        ]);
    }
}
