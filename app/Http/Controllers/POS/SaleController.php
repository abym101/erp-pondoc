<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\InventoryService;
use App\Services\PeriodLockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        return Sale::latest()->get();
    }

    public function show(Sale $sale)
    {
        return $sale;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'invoice_no' => 'required|string',
            'customer_id' => 'required|integer',
            'posting_date' => 'nullable|date',
            'payment_status' => 'nullable|string',
            'paid_amount' => 'nullable|numeric|min:0',
            'due_date' => 'nullable|date',
            'items' => 'required|array|min:1',
        ]);
        $postingDate =
            $data['posting_date']
            ?? now()->toDateString();
        PeriodLockService::validate(
            $postingDate
        );
        DB::transaction(function () use (
            $data,
            $postingDate
        ) {
            $grandTotal = 0;
            foreach ($data['items'] as $item) {
                $grandTotal +=
                    $item['qty']
                    * $item['price'];
            }
            $paymentStatus =
                strtoupper(
                    $data['payment_status']
                    ?? 'PAID'
                );
            $sale =
            Sale::create([
                'invoice_no' => $data['invoice_no'],
                'customer_id' => $data['customer_id'],
                'grand_total' => $grandTotal,
                'posting_date' => $postingDate,
                'payment_status' => $paymentStatus,
                'paid_amount' => $data['paid_amount']
                    ?? $grandTotal,
                'due_date' => $data['due_date']
                    ?? null,
            ]);
            $totalHpp = 0;
            foreach ($data['items'] as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty']
                        * $item['price'],
                ]);
                $cost =
                InventoryService::issue(
                    $item['product_id'],
                    $item['qty'],
                    $postingDate,
                    'SALE',
                    'SALE '.$sale->invoice_no
                );
                $totalHpp += $cost;
            }
            $salesAccount =
            Account::where(
                'code',
                '4000'
            )->firstOrFail();
            if (
                $paymentStatus === 'UNPAID'
            ) {
                $ar =
                Account::where(
                    'code',
                    '1200'
                )->firstOrFail();
                JournalEntry::create([
                    'account_id' => $ar->id,
                    'posting_date' => $postingDate,
                    'debit' => $grandTotal,
                    'credit' => 0,
                    'description' => 'SALE '.$sale->invoice_no,
                ]);
            } else {
                $cash =
                Account::where(
                    'code',
                    '1000'
                )->firstOrFail();
                JournalEntry::create([
                    'account_id' => $cash->id,
                    'posting_date' => $postingDate,
                    'debit' => $grandTotal,
                    'credit' => 0,
                    'description' => 'SALE '.$sale->invoice_no,
                ]);
            }
            JournalEntry::create([
                'account_id' => $salesAccount->id,
                'posting_date' => $postingDate,
                'debit' => 0,
                'credit' => $grandTotal,
                'description' => 'SALE '.$sale->invoice_no,
            ]);
            $hpp =
            Account::where(
                'code',
                '5200'
            )->firstOrFail();
            $inventory =
            Account::where(
                'code',
                '1300'
            )->firstOrFail();
            JournalEntry::create([
                'account_id' => $hpp->id,
                'posting_date' => $postingDate,
                'debit' => $totalHpp,
                'credit' => 0,
                'description' => 'HPP '.$sale->invoice_no,
            ]);
            JournalEntry::create([
                'account_id' => $inventory->id,
                'posting_date' => $postingDate,
                'debit' => 0,
                'credit' => $totalHpp,
                'description' => 'HPP '.$sale->invoice_no,
            ]);
        });

        return response()->json([
            'success' => true,
        ]);
    }

    public function update(
        Request $request,
        Sale $sale
    ) {
        return response()->json([
            'error' => 'POSTED SALES CANNOT BE EDITED',
        ], 422);
    }

    public function destroy(
        Sale $sale
    ) {
        return response()->json([
            'error' => 'POSTED SALES CANNOT BE DELETED',
        ], 422);
    }
}
