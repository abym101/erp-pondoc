<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;

class TrialBalanceController extends Controller
{
    public function index()
    {
        $rows = [];
        foreach (Account::all() as $account) {
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
            $rows[] = [
                'code' => $account->code,
                'name' => $account->name,
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $debit - $credit,
            ];
        }

        return response()->json($rows);
    }
}
