<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;

class TrialBalanceController extends Controller
{
    public function index()
    {
        $rows = [];
        $totalDebit = 0;
        $totalCredit = 0;
        foreach (
            Account::orderBy('code')->get() as $account
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
            $rows[] = [
                'code' => $account->code,
                'name' => $account->name,
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $balance,
            ];
            $totalDebit += $debit;
            $totalCredit += $credit;
        }

        return response()->json([
            'accounts' => $rows,
            'total_debit' => $totalDebit,
            'total_credit' => $totalCredit,
            'balanced' => (
                round($totalDebit, 2)
                ==
                round($totalCredit, 2)
            ),
        ]);
    }
}
