<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Guardian;
class WaliSantriController extends Controller
{
    public function index()
    {
        return response()->json([
            'total'=>Guardian::count(),
            'data'=>Guardian::latest()->limit(100)->get()
        ]);
    }
}
