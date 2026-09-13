<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AssetDepreciation;
use App\Models\FixedAsset;
use App\Models\JournalEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FixedAssetProcessController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'asset_code' => 'required',
            'asset_name' => 'required',
            'acquisition_date' => 'required|date',
            'acquisition_cost' => 'required|numeric',
            'salvage_value' => 'required|numeric',
            'useful_life_months' => 'required|integer',
        ]);
        $asset = FixedAsset::create([
            'asset_code' => $data['asset_code'],
            'asset_name' => $data['asset_name'],
            'acquisition_date' => $data['acquisition_date'],
            'acquisition_cost' => $data['acquisition_cost'],
            'salvage_value' => $data['salvage_value'],
            'useful_life_months' => $data['useful_life_months'],
            'accumulated_depreciation' => 0,
            'book_value' => $data['acquisition_cost'],
            'status' => 'ACTIVE',
        ]);

        return response()->json($asset);
    }

    public function runDepreciation()
    {
        DB::transaction(function () {
            $assetAccount =
            Account::where('code', '1500')->value('id');
            $accumAccount =
            Account::where('code', '1510')->value('id');
            $expenseAccount =
            Account::where('code', '5300')->value('id');
            foreach (
                FixedAsset::where('status', 'ACTIVE')->get() as $asset
            ) {
                $monthly =
                (
                    $asset->acquisition_cost
                    -
                    $asset->salvage_value
                )
                /
                max(
                    1,
                    $asset->useful_life_months
                );
                $newAccum =
                $asset->accumulated_depreciation
                +
                $monthly;
                $newBook =
                max(
                    $asset->salvage_value,
                    $asset->acquisition_cost
                    -
                    $newAccum
                );
                AssetDepreciation::create([
                    'fixed_asset_id' => $asset->id,
                    'posting_date' => Carbon::today(),
                    'depreciation_amount' => $monthly,
                    'accumulated_depreciation' => $newAccum,
                    'book_value' => $newBook,
                ]);
                $asset->update([
                    'accumulated_depreciation' => $newAccum,
                    'book_value' => $newBook,
                ]);
                JournalEntry::create([
                    'account_id' => $expenseAccount,
                    'posting_date' => Carbon::today(),
                    'debit' => $monthly,
                    'credit' => 0,
                    'description' => 'ASSET DEPRECIATION',
                ]);
                JournalEntry::create([
                    'account_id' => $accumAccount,
                    'posting_date' => Carbon::today(),
                    'debit' => 0,
                    'credit' => $monthly,
                    'description' => 'ASSET DEPRECIATION',
                ]);
            }
        });

        return response()->json([
            'success' => true,
        ]);
    }
}
