<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TahfidzRecord extends Model
{
    protected $fillable = [
        'santri_id',
        'tanggal',
        'surat',
        'ayat_awal',
        'ayat_akhir',
        'nilai'
    ];
}
