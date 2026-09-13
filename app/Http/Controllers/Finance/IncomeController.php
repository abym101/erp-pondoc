<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        return CashTransaction::where(
            'type',
            'IN'
        )->latest()->get();
    }

    public function store(Request $request)
    {
        return CashTransaction::create([
            'type' => 'IN',
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
    }
}
