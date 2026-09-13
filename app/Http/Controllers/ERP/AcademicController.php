<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\TahfidzRecord;
class AcademicController extends Controller
{
    public function index()
    {
        return response()->json([
            'santri'=>Santri::count(),
            'teachers'=>Teacher::count(),
            'subjects'=>Subject::count(),
            'attendance'=>Attendance::count(),
            'tahfidz_records'=>TahfidzRecord::count(),
            'generated_at'=>now()
        ]);
    }
}
