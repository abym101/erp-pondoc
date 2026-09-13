<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SppBill extends Model
{
    protected $fillable = [
        'santri_id',
        'periode',
        'amount',
        'status'
    ];
}
