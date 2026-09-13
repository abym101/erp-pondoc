<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\GoodsReceipt;
class GoodsReceiptController extends Controller{
public function index(){
return response()->json(GoodsReceipt::all());
}}
