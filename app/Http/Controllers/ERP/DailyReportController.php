<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\WorkOrder;

class DailyReportController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        return response()->json([
            'date' => $today,
            'sales_count' => Sale::whereDate(
                'created_at',
                $today
            )->count(),
            'sales_total' => Sale::whereDate(
                'created_at',
                $today
            )->sum(
                'grand_total'
            ),
            'work_order_count' => WorkOrder::whereDate(
                'created_at',
                $today
            )->count(),
            'work_order_total' => WorkOrder::whereDate(
                'created_at',
                $today
            )->sum(
                'total'
            ),
        ]);
    }
}
