<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Services\InventoryService;
use App\Services\PeriodLockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        return Purchase::latest()->get();
    }

    public function show(Purchase $purchase)
    {
        return $purchase;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|integer',
            'invoice_no' => 'required|string',
            'payment_status' => 'nullable|string',
            'posting_date' => 'nullable|date',
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
                    ?? 'UNPAID'
                );
            $purchase =
            Purchase::create([
                'supplier_id' => $data['supplier_id'],
                'invoice_no' => $data['invoice_no'],
                'grand_total' => $grandTotal,
                'payment_status' => $paymentStatus,
                'posting_date' => $postingDate,
                'paid_amount' => $data['paid_amount']
                    ?? 0,
                'due_date' => $data['due_date']
                    ?? null,
            ]);
            foreach ($data['items'] as $item) {
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty']
                        * $item['price'],
                ]);
                InventoryService::receive(
                    $item['product_id'],
                    $item['qty'],
                    $item['price'],
                    $postingDate,
                    'PURCHASE',
                    'PURCHASE '.$purchase->invoice_no,
                    $purchase->id
                );
            }
            $inventory =
            Account::where(
                'code',
                '1300'
            )->firstOrFail();
            JournalEntry::create([
                'account_id' => $inventory->id,
                'posting_date' => $postingDate,
                'debit' => $grandTotal,
                'credit' => 0,
                'description' => 'PURCHASE '.$purchase->invoice_no,
            ]);
            if (
                $paymentStatus === 'PAID'
            ) {
                $cash =
                Account::where(
                    'code',
                    '1000'
                )->firstOrFail();
                JournalEntry::create([
                    'account_id' => $cash->id,
                    'posting_date' => $postingDate,
                    'debit' => 0,
                    'credit' => $grandTotal,
                    'description' => 'PURCHASE '.$purchase->invoice_no,
                ]);
            } else {
                $ap =
                Account::where(
                    'code',
                    '2100'
                )->firstOrFail();
                JournalEntry::create([
                    'account_id' => $ap->id,
                    'posting_date' => $postingDate,
                    'debit' => 0,
                    'credit' => $grandTotal,
                    'description' => 'PURCHASE '.$purchase->invoice_no,
                ]);
            }
        });

        return response()->json([
            'success' => true,
        ]);
    }

    public function update(
        Request $request,
        Purchase $purchase
    ) {
        return response()->json([
            'error' => 'POSTED PURCHASE CANNOT BE EDITED',
        ], 422);
    }

    public function destroy(
        Purchase $purchase
    ) {
        return response()->json([
            'error' => 'POSTED PURCHASE CANNOT BE DELETED',
        ], 422);
    }
}
