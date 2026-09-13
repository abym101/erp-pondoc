<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
class AttendanceController extends Controller{
public function index(){ return response()->json(Attendance::all()); }
}
