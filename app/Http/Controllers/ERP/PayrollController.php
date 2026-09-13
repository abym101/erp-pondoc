<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
class PayrollController extends Controller{
public function index(){ return response()->json(Payroll::all()); }
}
