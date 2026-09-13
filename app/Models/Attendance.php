# ============================================================
# ERP PONDOK PHASE-4 AUTO BUILDER
# AKADEMIK + ABSENSI + HAFALAN + PEMBAYARAN SANTRI
# ============================================================
Set-Location C:\ERP\backend
# ============================================================
# MODELS
# ============================================================
php artisan make:model Attendance -m --no-interaction
php artisan make:model TahfidzRecord -m --no-interaction
php artisan make:model Subject -m --no-interaction
php artisan make:model Teacher -m --no-interaction
php artisan make:model Grade -m --no-interaction
# ============================================================
# MODELS CONTENT
# ============================================================
@'
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{
    protected $fillable = [
        'santri_id',
        'attendance_date',
        'status',
        'note'
    ];
}
