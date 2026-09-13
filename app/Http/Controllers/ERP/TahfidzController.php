<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\TahfidzRecord;
class TahfidzController extends Controller
{
    public function index()
    {
        return response()->json([
            'records'=>TahfidzRecord::count(),
            'data'=>TahfidzRecord::latest()->limit(100)->get()
        ]);
    }
}
