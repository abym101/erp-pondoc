<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\WorkOrder;
use App\Models\CashTransaction;
class ExecutiveDashboardController extends Controller
{
    public function index()
    {
        return view('erp.dashboard',[
            'products'        => Product::count(),
            'sales'           => Sale::count(),
            'purchases'       => Purchase::count(),
            'work_orders'     => WorkOrder::count(),
            'today_sales'     => Sale::whereDate('created_at',today())->count(),
            'cash_balance'    => CashTransaction::sum('amount'),
            'low_stock_count' => Product::where('stock','<',5)->count(),
        ]);
    }
}
