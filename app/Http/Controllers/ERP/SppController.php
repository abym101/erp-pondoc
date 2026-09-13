<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\SppBill;
use App\Models\SppPayment;
class SppController extends Controller
{
    public function index()
    {
        return response()->json([
            'bills'=>SppBill::count(),
            'payments'=>SppPayment::count(),
            'billing_total'=>SppBill::sum('amount'),
            'payment_total'=>SppPayment::sum('amount')
        ]);
    }
}
