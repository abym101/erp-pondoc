<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\PeriodLock;
use Illuminate\Http\Request;

class PeriodClosingController extends Controller
{
    public function index()
    {
        return PeriodLock::orderByDesc(
            'period_end'
        )->get();
    }

    public function store(
        Request $request
    ) {
        $data =
        $request->validate([
            'period_end' => 'required|date',
        ]);
        $exists =
        PeriodLock::where(
            'period_end',
            $data['period_end']
        )->exists();
        if ($exists) {
            return response()->json([
                'error' => 'PERIOD ALREADY CLOSED',
            ], 422);
        }
        PeriodLock::create([
            'period_end' => $data['period_end'],
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
