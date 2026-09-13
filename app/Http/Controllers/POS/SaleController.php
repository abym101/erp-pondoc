<?php
namespace App\Http\Controllers\POS;
use App\Http\Controllers\Controller;
use App\Models\Sale;
class SaleController extends Controller
{
    public function index()
    {
        return view(
            'sales.index',
            [
                'sales'=>Sale::latest()->get()
            ]
        );
    }
}
