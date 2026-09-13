<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
class CashBankController extends Controller
{
    public function index()
    {
        return response()->json([
            'transactions'=>CashTransaction::latest()->limit(100)->get(),
            'balance'=>CashTransaction::sum('amount')
        ]);
    }
}
