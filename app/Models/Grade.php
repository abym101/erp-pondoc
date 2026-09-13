<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Grade extends Model
{
    protected $fillable = [
        'santri_id',
        'subject_id',
        'semester',
        'nilai'
    ];
}
