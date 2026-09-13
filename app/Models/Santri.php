# ============================================================
# ERP PONDOK PHASE-3 AUTO BUILDER
# HRM + SANTRI + KEUANGAN PONDOK + DONASI + API
# ============================================================
Set-Location C:\ERP\backend
# ------------------------------------------------------------
# MODELS
# ------------------------------------------------------------
php artisan make:model Santri -m --no-interaction
php artisan make:model Kelas -m --no-interaction
php artisan make:model Asrama -m --no-interaction
php artisan make:model Donasi -m --no-interaction
php artisan make:model SppPayment -m --no-interaction
php artisan make:model Employee -m --no-interaction
php artisan make:model Payroll -m --no-interaction
# ------------------------------------------------------------
# SANTRI MODEL
# ------------------------------------------------------------
@'
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Santri extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'asrama',
        'wali',
        'hp_wali',
        'status'
    ];
}
