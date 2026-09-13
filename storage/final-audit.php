<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(
    Illuminate\Contracts\Console\Kernel::class
)->bootstrap();
echo PHP_EOL;
echo "========== ERP FINAL AUDIT ==========".PHP_EOL;
echo PHP_EOL;
echo "SALES=".App\Models\Sale::count().PHP_EOL;
echo "PURCHASES=".App\Models\Purchase::count().PHP_EOL;
echo "JOURNALS=".App\Models\JournalEntry::count().PHP_EOL;
echo PHP_EOL;
echo "===== ACCOUNT BALANCES =====".PHP_EOL;
foreach(
    App\Models\Account::orderBy('code')->get()
    as $a
){
    $d =
    App\Models\JournalEntry::where(
        'account_id',
        $a->id
    )->sum('debit');
    $c =
    App\Models\JournalEntry::where(
        'account_id',
        $a->id
    )->sum('credit');
    echo
    $a->code.' | '.
    $a->name.' | '.
    $a->type.' | D='.
    $d.' | C='.
    $c.' | BAL='.
    ($d-$c).
    PHP_EOL;
}
echo PHP_EOL;
$asset=0;
$liability=0;
$equity=0;
$revenue=0;
$expense=0;
foreach(
    App\Models\Account::all()
    as $a
){
    $d=
    App\Models\JournalEntry::where(
        'account_id',
        $a->id
    )->sum('debit');
    $c=
    App\Models\JournalEntry::where(
        'account_id',
        $a->id
    )->sum('credit');
    $bal=$d-$c;
    switch($a->type){
        case 'ASSET':
            $asset += $bal;
            break;
        case 'LIABILITY':
            $liability += abs($bal);
            break;
        case 'EQUITY':
            $equity += abs($bal);
            break;
        case 'REVENUE':
            $revenue += ($c-$d);
            break;
        case 'EXPENSE':
            $expense += ($d-$c);
            break;
    }
}
$currentProfit =
    $revenue - $expense;
echo "===== BALANCE SHEET =====".PHP_EOL;
echo "ASSET=".$asset.PHP_EOL;
echo "LIABILITY=".$liability.PHP_EOL;
echo "EQUITY=".$equity.PHP_EOL;
echo "CURRENT_PROFIT=".$currentProfit.PHP_EOL;
echo
"BALANCED=".
(
    $asset ==
    ($liability + $equity)
    ? 'YES'
    : 'NO'
).
PHP_EOL;
echo PHP_EOL;
echo "===== PERIODS =====".PHP_EOL;
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
echo "===== LAST 20 JOURNALS =====".PHP_EOL;
foreach(
    App\Models\JournalEntry::latest()
    ->take(20)
    ->get()
    as $j
){
    echo
    $j->id.' | '.
    $j->posting_date.' | '.
    $j->account_id.' | D='.
    $j->debit.' | C='.
    $j->credit.' | '.
    $j->description.
    PHP_EOL;
}
echo PHP_EOL;
echo "========== END AUDIT ==========".PHP_EOL;
