<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Musyrif;
class MusyrifController extends Controller{
public function index(){ return response()->json(Musyrif::all()); }
}
