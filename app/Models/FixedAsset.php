<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedAsset extends Model
{
    protected $table = 'fixed_assets';

    protected $fillable = [
        'asset_code',
        'asset_name',
        'acquisition_date',
        'acquisition_cost',
        'salvage_value',
        'useful_life_months',
        'accumulated_depreciation',
        'book_value',
        'status',
    ];
}
