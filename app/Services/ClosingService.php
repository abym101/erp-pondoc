<?php

namespace App\Services;

use App\Models\Account;
use App\Models\AccountingPeriod;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\DB;

class ClosingService
{
    public static function closePeriod(string $period)
    {
        DB::transaction(function () use ($period) {
            $retained =
                Account::where(
                    'code',
                    '3100'
                )->firstOrFail();
            foreach (
                Account::where(
                    'type',
                    'REVENUE'
                )->get() as $account
            ) {
                $debit =
                    JournalEntry::where(
                        'account_id',
                        $account->id
                    )->sum('debit');
                $credit =
                    JournalEntry::where(
                        'account_id',
                        $account->id
                    )->sum('credit');
                $balance =
                    $credit - $debit;
                if ($balance > 0) {
                    JournalEntry::create([
                        'account_id' => $account->id,
                        'debit' => $balance,
                        'credit' => 0,
                        'description' => 'CLOSE REVENUE '.$period,
                    ]);
                    JournalEntry::create([
                        'account_id' => $retained->id,
                        'debit' => 0,
                        'credit' => $balance,
                        'description' => 'CLOSE REVENUE '.$period,
                    ]);
                }
            }
            foreach (
                Account::where(
                    'type',
                    'EXPENSE'
                )->get() as $account
            ) {
                $debit =
                    JournalEntry::where(
                        'account_id',
                        $account->id
                    )->sum('debit');
                $credit =
                    JournalEntry::where(
                        'account_id',
                        $account->id
                    )->sum('credit');
                $balance =
                    $debit - $credit;
                if ($balance > 0) {
                    JournalEntry::create([
                        'account_id' => $retained->id,
                        'debit' => $balance,
                        'credit' => 0,
                        'description' => 'CLOSE EXPENSE '.$period,
                    ]);
                    JournalEntry::create([
                        'account_id' => $account->id,
                        'debit' => 0,
                        'credit' => $balance,
                        'description' => 'CLOSE EXPENSE '.$period,
                    ]);
                }
            }
            AccountingPeriod::updateOrCreate(
                [
                    'period' => $period,
                ],
                [
                    'start_date' => date('Y-m-01'),
                    'end_date' => date('Y-m-t'),
                    'is_closed' => true,
                    'closed_at' => now(),
                ]
            );
        });

        return true;
    }
}
