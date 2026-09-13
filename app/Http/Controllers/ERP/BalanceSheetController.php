<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountingPeriod;
use App\Models\JournalEntry;

class BalanceSheetController extends Controller
{
    public function index()
    {
        $asset = 0;
        $liability = 0;
        $equity = 0;
        $revenue = 0;
        $expense = 0;
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
            $balance =
                $debit - $credit;
            switch ($account->type) {
                case 'ASSET':
                    $asset += $balance;
                    break;
                case 'LIABILITY':
                    $liability += abs($balance);
                    break;
                case 'EQUITY':
                    $equity += abs($balance);
                    break;
                case 'REVENUE':
                    $revenue +=
                        ($credit - $debit);
                    break;
                case 'EXPENSE':
                    $expense +=
                        ($debit - $credit);
                    break;
            }
        }
        $currentProfit =
            $revenue - $expense;
        $closedPeriodExists =
            AccountingPeriod::where(
                'is_closed',
                true
            )->exists();
        if (! $closedPeriodExists) {
            $equity +=
                $currentProfit;
        }

        return response()->json([
            'asset' => $asset,
            'liability' => $liability,
            'equity' => $equity,
            'current_profit' => $currentProfit,
            'period_closed' => $closedPeriodExists,
            'balanced' => $asset ==
                ($liability + $equity),
        ]);
    }
}
