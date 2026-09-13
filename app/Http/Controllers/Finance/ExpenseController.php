<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return CashTransaction::where(
            'type',
            'OUT'
        )->latest()->get();
    }

    public function store(Request $request)
    {
        return CashTransaction::create([
            'type' => 'OUT',
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
    }
}
