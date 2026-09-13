# =========================================================
# ERP PONDOK PHASE-2 AUTO BUILDER
# Inventory + Purchasing + Sales + Workshop + Accounting
# Dashboard KPI + API Health + Git Backup
# =========================================================
Set-Location C:\ERP\backend
Write-Host ""
Write-Host "====================================="
Write-Host " ERP PONDOK PHASE-2 AUTO BUILDER"
Write-Host "====================================="
Write-Host ""
# ---------------------------------------------------------
# CREATE PHASE-2 CONTROLLERS
# ---------------------------------------------------------
php artisan make:controller ERP/ExecutiveDashboardController --no-interaction
php artisan make:controller ERP/CashBankController --no-interaction
php artisan make:controller ERP/InventoryKpiController --no-interaction
php artisan make:controller ERP/PurchaseKpiController --no-interaction
php artisan make:controller ERP/SalesKpiController --no-interaction
php artisan make:controller ERP/WorkshopReportController --no-interaction
# ---------------------------------------------------------
# EXECUTIVE DASHBOARD
# ---------------------------------------------------------
@'
<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\WorkOrder;
use App\Models\CashTransaction;
class ExecutiveDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'products'      => Product::count(),
            'sales'         => Sale::count(),
            'purchases'     => Purchase::count(),
            'work_orders'   => WorkOrder::count(),
            'cash_balance'  => CashTransaction::sum('amount'),
            'generated_at'  => now()
        ]);
    }
}
