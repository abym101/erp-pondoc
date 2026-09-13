<?php

namespace App\Console\Commands;

use App\Services\ClosingService;
use Illuminate\Console\Command;

class ClosePeriodCommand extends Command
{
    protected $signature =
        'erp:close-period {period}';

    protected $description =
        'Close Accounting Period';

    public function handle()
    {
        $period =
            $this->argument(
                'period'
            );
        $profit =
            ClosingService::closePeriod(
                $period
            );
        $this->info(
            'PERIOD CLOSED'
        );
        $this->info(
            'PROFIT='.$profit
        );

        return self::SUCCESS;
    }
}
