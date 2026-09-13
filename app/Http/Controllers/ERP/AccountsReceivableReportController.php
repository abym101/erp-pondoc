<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\AccountReceivable;
class AccountsReceivableReportController extends Controller{
public function index(){
return response()->json([
'total_receivable'=>AccountReceivable::sum('balance'),
'rows'=>AccountReceivable::count()
]);
}}
