<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'grand_total',
        'payment_status',
        'posting_date',
        'paid_amount',
        'due_date',
    ];

    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class
        );
    }

    protected static function booted()
    {
        static::updating(function () {
            throw new \Exception(
                'POSTED PURCHASE CANNOT BE EDITED'
            );
        });
        static::deleting(function () {
            throw new \Exception(
                'POSTED PURCHASE CANNOT BE DELETED'
            );
        });
    }
}
