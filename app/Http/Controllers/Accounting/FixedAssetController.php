<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\FixedAsset;

class FixedAssetController extends Controller
{
    public function index()
    {
        return response()->json([
            'assets' => FixedAsset::all(),
            'total_cost' => FixedAsset::sum('acquisition_cost'),
            'total_book_value' => FixedAsset::sum('book_value'),
            'total_accumulated_depreciation' => FixedAsset::sum('accumulated_depreciation'),
        ]);
    }
}
