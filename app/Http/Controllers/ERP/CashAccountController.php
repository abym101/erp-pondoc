<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\CashAccount;
class CashAccountController extends Controller{
public function index(){ return response()->json(CashAccount::all()); }
}
