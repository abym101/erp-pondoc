<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Donation;
use App\Models\Product;
use App\Models\WorkOrder;
class PondokDashboardController extends Controller{
public function index(){
return response()->json([
'santri'=>Santri::count(),
'donations'=>Donation::sum('amount'),
'products'=>Product::count(),
'work_orders'=>WorkOrder::count()
]);
}}
