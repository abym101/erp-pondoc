<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDepreciation extends Model
{
    protected $table = 'asset_depreciations';

    protected $fillable = [
        'fixed_asset_id',
        'posting_date',
        'depreciation_amount',
        'accumulated_depreciation',
        'book_value',
    ];
}
