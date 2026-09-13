<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $fillable = [
        'purchase_id',
        'posting_date',
        'amount',
        'method',
    ];

    public function purchase()
    {
        return $this->belongsTo(
            Purchase::class
        );
    }
}
