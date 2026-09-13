<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\StudentSaving;
use App\Models\SppBill;
use App\Models\SppPayment;
class KeuanganSantriDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'wali_santri'=>Guardian::count(),
            'tabungan_aktif'=>StudentSaving::count(),
            'saldo_tabungan'=>StudentSaving::sum('balance'),
            'tagihan_spp'=>SppBill::sum('amount'),
            'pembayaran_spp'=>SppPayment::sum('amount'),
            'generated_at'=>now()
        ]);
    }
}
