<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function sales()
    {
        return Sale::latest()->get();
    }

    public function stocks()
    {
        return Product::orderBy('stock')->get();
    }

    public function workorders()
    {
        return WorkOrder::latest()->get();
    }

    public function invoice(Sale $sale)
    {
        $html = '
        <h2>Invoice '.$sale->invoice_no.'</h2>
        <hr>
        <p>Total : Rp '.number_format($sale->grand_total, 0, ',', '.').'</p>
        ';

        return Pdf::loadHTML($html)->stream();
    }
}
