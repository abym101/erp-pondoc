<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
class WorkshopReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'work_orders'=>WorkOrder::count(),
            'open'=>WorkOrder::where('status','OPEN')->count(),
            'closed'=>WorkOrder::where('status','CLOSED')->count()
        ]);
    }
}
