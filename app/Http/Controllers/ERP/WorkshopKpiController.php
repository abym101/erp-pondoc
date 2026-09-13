<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use App\Models\WorkOrderItem;
use App\Models\WorkOrderService;

class WorkshopKpiController extends Controller
{
    public function index()
    {
        return response()->json([
            'work_orders' => WorkOrder::count(),
            'open_work_orders' => WorkOrder::where(
                'status',
                'OPEN'
            )->count(),
            'closed_work_orders' => WorkOrder::where(
                'status',
                'CLOSED'
            )->count(),
            'service_total' => WorkOrderService::sum(
                'price'
            ),
            'sparepart_total' => WorkOrderItem::sum(
                'subtotal'
            ),
            'revenue_total' => WorkOrder::sum(
                'total'
            ),
            'profit_total' => WorkOrder::sum(
                'profit'
            ),
            'today_work_orders' => WorkOrder::whereDate(
                'created_at',
                today()
            )->count(),
            'today_revenue' => WorkOrder::whereDate(
                'created_at',
                today()
            )->sum(
                'total'
            ),
        ]);
    }
}
