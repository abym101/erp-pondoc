<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\AssetDepreciation;
use App\Models\FixedAsset;

class DepreciationController extends Controller
{
    public function index()
    {
        return response()->json([
            'assets' => FixedAsset::count(),
            'depreciations' => AssetDepreciation::count(),
            'total_book_value' => FixedAsset::sum('book_value'),
            'total_accumulated_depreciation' => FixedAsset::sum('accumulated_depreciation'),
        ]);
    }
}
