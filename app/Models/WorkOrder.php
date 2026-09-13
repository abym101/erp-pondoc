<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(
            Customer::class
        );
    }

    public function vehicle()
    {
        return $this->belongsTo(
            Vehicle::class
        );
    }

    public function items()
    {
        return $this->hasMany(
            WorkOrderItem::class
        );
    }

    public function services()
    {
        return $this->hasMany(
            ServiceJob::class
        );
    }
}
