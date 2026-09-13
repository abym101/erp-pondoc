<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Donasi;
use App\Models\Employee;
use App\Models\Payroll;
class PondokDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'santri'=>Santri::count(),
            'pegawai'=>Employee::count(),
            'donasi'=>Donasi::sum('nominal'),
            'payroll'=>Payroll::sum('total'),
            'generated_at'=>now()
        ]);
    }
}
