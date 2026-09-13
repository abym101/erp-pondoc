<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JournalEntry;

class CashFlowController extends Controller
{
    public function index()
    {
        $cashAccountIds =
            Account::whereIn(
                'code',
                ['1000', '1100']
            )->pluck('id');
        $cashIn =
            JournalEntry::whereIn(
                'account_id',
                $cashAccountIds
            )->sum('debit');
        $cashOut =
            JournalEntry::whereIn(
                'account_id',
                $cashAccountIds
            )->sum('credit');

        return response()->json([
            'cash_in' => $cashIn,
            'cash_out' => $cashOut,
            'balance' => $cashIn - $cashOut,
        ]);
    }
}
