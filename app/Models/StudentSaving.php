<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StudentSaving extends Model
{
    protected $fillable = [
        'santri_id',
        'balance'
    ];
}
