<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Employee extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'gaji_pokok',
        'status'
    ];
}
