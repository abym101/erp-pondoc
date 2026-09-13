<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;

class ProfitLossController extends Controller
{
    public function index()
    {
        $revenue = 0;
        $expense = 0;
        $accounts =
            Account::all();
        foreach ($accounts as $account) {
            $credit =
                JournalEntry::where(
                    'account_id',
                    $account->id
                )->sum('credit');
            $debit =
                JournalEntry::where(
                    'account_id',
                    $account->id
                )->sum('debit');
            if (
                str_starts_with(
                    $account->code,
                    '4'
                )
            ) {
                $revenue +=
                    ($credit - $debit);
            }
            if (
                str_starts_with(
                    $account->code,
                    '5'
                )
            ) {
                $expense +=
                    ($debit - $credit);
            }
        }

        return response()->json([
            'revenue' => $revenue,
            'expense' => $expense,
            'profit' => $revenue - $expense,
        ]);
    }
}
