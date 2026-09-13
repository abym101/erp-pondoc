<?php
echo PHP_EOL;
echo "=========== ERP ACCOUNTING AUDIT ===========" . PHP_EOL;
echo PHP_EOL;
echo "ACCOUNTS=" .
App\Models\Account::count() .
PHP_EOL;
echo "JOURNALS=" .
App\Models\JournalEntry::count() .
PHP_EOL;
echo "SALES=" .
App\Models\Sale::count() .
PHP_EOL;
echo "PURCHASES=" .
App\Models\Purchase::count() .
PHP_EOL;
echo "PERIODS=" .
App\Models\AccountingPeriod::count() .
PHP_EOL;
echo PHP_EOL;
echo "===== ACCOUNT BALANCES =====" . PHP_EOL;
foreach(
    App\Models\Account::orderBy('code')->get()
    as $a
){
    $debit =
    App\Models\JournalEntry::where(
        'account_id',
        $a->id
    )->sum('debit');
    $credit =
    App\Models\JournalEntry::where(
        'account_id',
        $a->id
    )->sum('credit');
    echo
    $a->code . ' | ' .
    $a->name . ' | ' .
    $a->type . ' | D=' .
    $debit . ' | C=' .
    $credit . ' | BAL=' .
    ($debit - $credit) .
    PHP_EOL;
}
echo PHP_EOL;
echo "===== LAST 20 JOURNALS =====" . PHP_EOL;
foreach(
    App\Models\JournalEntry::with('account')
    ->latest()
    ->take(20)
    ->get()
    as $j
){
    echo
    $j->id . ' | ' .
    ($j->account->code ?? '-') . ' | ' .
    ($j->account->name ?? '-') . ' | D=' .
    $j->debit . ' | C=' .
    $j->credit . ' | ' .
    $j->description .
    PHP_EOL;
}
echo PHP_EOL;
echo "===== BALANCE SHEET =====" . PHP_EOL;
$asset=0;
$liability=0;
$equity=0;
$revenue=0;
$expense=0;
foreach(
    App\Models\Account::all()
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
    $bal = $d - $c;
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
echo 'ASSET=' .
$asset .
PHP_EOL;
echo 'LIABILITY=' .
$liability .
PHP_EOL;
echo 'EQUITY=' .
$equity .
PHP_EOL;
echo 'CURRENT_PROFIT=' .
$currentProfit .
PHP_EOL;
echo 'BALANCED=' .
(
    $asset ==
    ($liability + $equity)
    ? 'YES'
    : 'NO'
) .
PHP_EOL;
echo PHP_EOL;
echo "=========== END AUDIT ===========" . PHP_EOL;
