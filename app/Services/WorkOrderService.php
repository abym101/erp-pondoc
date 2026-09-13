<?php

namespace App\Services;

use App\Models\CashTransaction;
use App\Models\WorkOrder;

class WorkOrderService
{
    public function close(
        $workOrderId,
        $total
    ) {
        $wo = WorkOrder::findOrFail($workOrderId);
        $wo->status = 'DONE';
        $wo->total = $total;
        $wo->save();
        CashTransaction::create([
            'trx_date' => date('Y-m-d'),
            'type' => 'IN',
            'category' => 'SERVICE',
            'description' => $wo->number,
            'amount' => $total,
        ]);

        return $wo;
    }
}
