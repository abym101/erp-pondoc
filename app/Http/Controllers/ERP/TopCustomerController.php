<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class TopCustomerController extends Controller
{
    public function index()
    {
        return Sale::select(
            'customer_id',
            DB::raw(
                'SUM(grand_total) total_sales'
            )
        )
            ->with(
                'customer'
            )
            ->groupBy(
                'customer_id'
            )
            ->orderByDesc(
                'total_sales'
            )
            ->limit(20)
            ->get();
    }
}
