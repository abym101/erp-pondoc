<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Budget;
class BudgetController extends Controller{
public function index(){
return response()->json(Budget::all());
}}
