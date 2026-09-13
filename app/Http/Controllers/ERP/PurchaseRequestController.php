<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
class PurchaseRequestController extends Controller{
public function index(){
return response()->json(PurchaseRequest::all());
}}
