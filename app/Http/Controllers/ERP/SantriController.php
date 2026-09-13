<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Santri;
class SantriController extends Controller{
public function index(){ return response()->json(Santri::all()); }
}
