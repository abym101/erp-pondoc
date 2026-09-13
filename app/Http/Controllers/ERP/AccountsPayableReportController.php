<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\AccountPayable;
class AccountsPayableReportController extends Controller{
public function index(){
return response()->json([
'total_payable'=>AccountPayable::sum('balance'),
'rows'=>AccountPayable::count()
]);
}}
