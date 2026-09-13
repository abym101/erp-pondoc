<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Donasi;
class DonasiController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_donasi'=>Donasi::sum('nominal'),
            'data'=>Donasi::latest()->limit(100)->get()
        ]);
    }
}
