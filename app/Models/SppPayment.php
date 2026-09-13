<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SppPayment extends Model
{
    protected $fillable = [
        'santri_id',
        'payment_date',
        'amount',
        'description'
    ];
}
