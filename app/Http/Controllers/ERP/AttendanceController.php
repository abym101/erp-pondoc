<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
class AttendanceController extends Controller
{
    public function index()
    {
        return response()->json([
            'total'=>Attendance::count(),
            'data'=>Attendance::latest()->limit(100)->get()
        ]);
    }
}
