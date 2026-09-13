<?php

namespace App\Services;

use App\Models\AccountingPeriod;
use Carbon\Carbon;
use Exception;

class PeriodLockService
{
    public static function validate(
        ?string $date = null
    ): void {
        $date =
            $date
            ? Carbon::parse($date)
            : now();
        $period =
            AccountingPeriod::where(
                'is_closed',
                true
            )
                ->where(
                    'start_date',
                    '<=',
                    $date->toDateString()
                )
                ->where(
                    'end_date',
                    '>=',
                    $date->toDateString()
                )
                ->first();
        if ($period) {
            throw new Exception(
                'ACCOUNTING PERIOD CLOSED : '.
                $period->period
            );
        }
    }
}
