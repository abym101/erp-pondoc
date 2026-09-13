<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrderService extends Model
{
    protected $guarded = [];

    public function serviceJob()
    {
        return $this->belongsTo(
            ServiceJob::class
        );
    }
}
