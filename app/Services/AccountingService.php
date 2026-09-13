<?php

namespace App\Services;

use App\Models\Account;
use App\Models\JournalEntry;

class AccountingService
{
    public static function postSale(
        float $amount,
        string $description = 'Penjualan'
    ): void {
        $cash =
            Account::where(
                'code',
                '1000'
            )->first();
        $sales =
            Account::where(
                'code',
                '4000'
            )->first();
        JournalEntry::create([
            'account_id' => $cash->id,
            'debit' => $amount,
            'credit' => 0,
            'description' => $description,
        ]);
        JournalEntry::create([
            'account_id' => $sales->id,
            'debit' => 0,
            'credit' => $amount,
            'description' => $description,
        ]);
    }

    public static function postPurchase(
        float $amount,
        string $description = 'Pembelian'
    ): void {
        $purchase =
            Account::where(
                'code',
                '5000'
            )->first();
        $cash =
            Account::where(
                'code',
                '1000'
            )->first();
        JournalEntry::create([
            'account_id' => $purchase->id,
            'debit' => $amount,
            'credit' => 0,
            'description' => $description,
        ]);
        JournalEntry::create([
            'account_id' => $cash->id,
            'debit' => 0,
            'credit' => $amount,
            'description' => $description,
        ]);
    }
}
