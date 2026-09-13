<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $wo = WorkOrder::with([
            'customer',
            'vehicle',
        ])->findOrFail($id);

        return view(
            'invoice.show',
            compact('wo')
        );
    }
}
