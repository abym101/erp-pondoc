<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\StudentSaving;
use App\Models\StudentSavingTransaction;
class TabunganController extends Controller
{
    public function index()
    {
        return response()->json([
            'accounts'=>StudentSaving::count(),
            'transactions'=>StudentSavingTransaction::count(),
            'balance'=>StudentSaving::sum('balance')
        ]);
    }
}
