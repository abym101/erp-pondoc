# ============================================================
# ERP PONDOK PHASE-6 AUTO BUILDER
# KEUANGAN SANTRI + TABUNGAN + SYAHRIYAH + WALI SANTRI
# ============================================================
Set-Location C:\ERP\backend
# ============================================================
# MODELS
# ============================================================
php artisan make:model Guardian -m --no-interaction
php artisan make:model StudentSaving -m --no-interaction
php artisan make:model StudentSavingTransaction -m --no-interaction
php artisan make:model SppBill -m --no-interaction
php artisan make:model SppPayment -m --no-interaction
# ============================================================
# MODEL FILES
# ============================================================
@'
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Guardian extends Model
{
    protected $fillable = [
        'santri_id',
        'nama',
        'hp',
        'alamat',
        'pekerjaan'
    ];
}
