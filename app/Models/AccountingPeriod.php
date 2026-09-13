<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountingPeriod extends Model
{
    protected $fillable = [
        'period',
        'start_date',
        'end_date',
        'is_closed',
        'closed_at',
    ];
}
