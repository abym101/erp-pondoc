<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\WorkOrder;
class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $sales = Sale::count();
        $purchases = Purchase::count();
        $work_orders = WorkOrder::count();
        $today_sales = 0;
        if(
            \Illuminate\Support\Facades\Schema::hasColumn(
                'sales',
                'total'
            )
        ){
            $today_sales =
            Sale::whereDate(
                'created_at',
                today()
            )->sum('total');
        }
        $cash_balance = 65000;
        $low_stock_count = 0;
        return view(
            'erp.dashboard',
            compact(
                'products',
                'sales',
                'purchases',
                'work_orders',
                'today_sales',
                'cash_balance',
                'low_stock_count'
            )
        );
    }
}
