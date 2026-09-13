<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(
    Illuminate\Contracts\Console\Kernel::class
)->bootstrap();
echo PHP_EOL;
echo "===== PERIOD LOCK AUDIT =====".PHP_EOL;
echo PHP_EOL;
echo "PERIODS=".
App\Models\AccountingPeriod::count().
PHP_EOL;
echo "JOURNALS_BEFORE=".
App\Models\JournalEntry::count().
PHP_EOL;
try {
    App\Models\JournalEntry::create([
        'account_id'  => 1,
        'debit'       => 123,
        'credit'      => 0,
        'description' => 'PERIOD LOCK TEST'
    ]);
    echo PHP_EOL;
    echo "RESULT=FAILED".PHP_EOL;
    echo "LOCK NOT ACTIVE".PHP_EOL;
}
catch (\Throwable $e) {
    echo PHP_EOL;
    echo "RESULT=SUCCESS".PHP_EOL;
    echo "LOCK ACTIVE".PHP_EOL;
    echo "MESSAGE=".$e->getMessage().PHP_EOL;
}
echo PHP_EOL;
echo "JOURNALS_AFTER=".
App\Models\JournalEntry::count().
PHP_EOL;
echo PHP_EOL;
echo "===== LAST 10 JOURNALS =====".PHP_EOL;
foreach(
    App\Models\JournalEntry::latest()
    ->take(10)
    ->get()
    as $j
){
    echo
    $j->id.' | '.
    $j->account_id.' | D='.
    $j->debit.' | C='.
    $j->credit.' | '.
    $j->description.
    PHP_EOL;
}
echo PHP_EOL;
echo "===== ACCOUNTING PERIODS =====".PHP_EOL;
foreach(
    App\Models\AccountingPeriod::all()
    as $p
){
    echo
    $p->period.' | '.
    $p->start_date.' | '.
    $p->end_date.' | CLOSED='.
    ($p->is_closed ? 'YES' : 'NO').
    PHP_EOL;
}
echo PHP_EOL;
echo "===== END AUDIT =====".PHP_EOL;
