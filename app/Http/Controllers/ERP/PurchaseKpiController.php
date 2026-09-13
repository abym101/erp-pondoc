<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
class PurchaseKpiController extends Controller
{
    public function index()
    {
        return response()->json([
            'purchase_count'=>Purchase::count()
        ]);
    }
}
