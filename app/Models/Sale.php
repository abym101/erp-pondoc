<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_no',
        'customer_id',
        'grand_total',
        'posting_date',
        'payment_status',
        'paid_amount',
        'due_date',
    ];

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(
            Customer::class
        );
    }

    public static bool $allowUpdate = false;

    protected static function booted()
    {
        static::updating(function () {
            if (
                static::$allowUpdate
            ) {
                return true;
            }
            throw new \Exception(
                'POSTED SALES CANNOT BE EDITED'
            );
        });
        static::deleting(function () {
            throw new \Exception(
                'POSTED SALES CANNOT BE DELETED'
            );
        });
    }
}
