<?php

namespace App\Models;

use App\Services\PeriodLockService;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = [
        'account_id',
        'posting_date',
        'debit',
        'credit',
        'description',
    ];

    protected static function booted()
    {
        static::creating(function ($journal) {
            $date =
                $journal->posting_date
                ?? now()->toDateString();
            PeriodLockService::validate(
                $date
            );
        });
    }

    public function account()
    {
        return $this->belongsTo(
            Account::class
        );
    }
}
