<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrderItem extends Model
{
    protected $guarded = [];

    public function workOrder()
    {
        return $this->belongsTo(
            WorkOrder::class
        );
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class
        );
    }
}
