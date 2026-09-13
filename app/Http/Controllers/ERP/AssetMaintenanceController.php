<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\AssetMaintenance;
class AssetMaintenanceController extends Controller{
public function index(){
return response()->json(AssetMaintenance::all());
}}
