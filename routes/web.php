<?php

use App\Http\Controllers\ERP\DailyReportController;
use App\Http\Controllers\ERP\DashboardController;
use App\Http\Controllers\ERP\ReportController;
use App\Http\Controllers\ERP\StockReportController;
use App\Http\Controllers\Inventory\CategoryController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\Inventory\PurchaseController;
use App\Http\Controllers\Inventory\SupplierController;
use App\Http\Controllers\POS\SaleController;
use App\Http\Controllers\Workshop\CustomerController;
use App\Http\Controllers\Workshop\VehicleController;
use App\Http\Controllers\Workshop\WorkOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/erp'));
Route::get(
    '/erp',
    [DashboardController::class, 'index']
);
Route::resource(
    '/erp/products',
    ProductController::class
);
Route::resource(
    '/erp/categories',
    CategoryController::class
);
Route::resource(
    '/erp/customers',
    CustomerController::class
);
Route::resource(
    '/erp/vehicles',
    VehicleController::class
);
Route::resource(
    '/erp/work-orders',
    WorkOrderController::class
);
Route::resource(
    '/erp/sales',
    SaleController::class
);
Route::prefix('erp/reports')->group(function () {
    Route::get(
        '/dashboard',
        [ReportController::class, 'dashboard']
    );
    Route::get(
        '/sales',
        [ReportController::class, 'sales']
    );
    Route::get(
        '/work-orders',
        [ReportController::class, 'workOrders']
    );
    Route::get(
        '/stock',
        [ReportController::class, 'stock']
    );
    Route::get(
        '/daily',
        [DailyReportController::class, 'index']
    );
});
use App\Http\Controllers\ERP\InvoiceController;

Route::get(
    '/erp/invoice/{id}',
    [InvoiceController::class, 'show']
);
use App\Http\Controllers\ERP\VehicleHistoryController;

Route::get(
    '/erp/history/vehicle/{id}',
    [VehicleHistoryController::class, 'show']
);
use App\Http\Controllers\ERP\KpiController;

Route::get(
    '/erp/kpi',
    [KpiController::class, 'index']
);
Route::resource(
    '/erp/purchases',
    PurchaseController::class
);
use App\Http\Controllers\Workshop\WorkOrderItemController;

Route::post(
    '/erp/work-order-items',
    [WorkOrderItemController::class, 'store']
);
use App\Http\Controllers\Workshop\WorkOrderServiceController;

Route::post(
    '/erp/work-order-services',
    [WorkOrderServiceController::class, 'store']
);
use App\Http\Controllers\ERP\WorkshopKpiController;

Route::get(
    '/erp/workshop-kpi',
    [WorkshopKpiController::class, 'index']
);
use App\Http\Controllers\ERP\FinanceController;

Route::get(
    '/erp/finance',
    [FinanceController::class, 'index']
);
use App\Http\Controllers\Accounting\ProfitLossController;

Route::get(
    '/erp/profit-loss',
    [ProfitLossController::class, 'index']
);
use App\Http\Controllers\ERP\CashFlowController;

Route::get(
    '/erp/cashflow',
    [CashFlowController::class, 'index']
);
use App\Http\Controllers\ERP\DashboardUiController;

Route::get(
    '/erp2',
    [DashboardUiController::class, 'index']
);
Route::get('/erp/suppliers', [SupplierController::class, 'index']);
Route::post('/erp/suppliers', [SupplierController::class, 'store']);
Route::get('/erp/purchases', [PurchaseController::class, 'index']);
Route::post('/erp/purchases', [PurchaseController::class, 'store']);
use App\Http\Controllers\ERP\HealthCheckController;

Route::get(
    '/erp/health',
    [HealthCheckController::class, 'index']
);
use App\Http\Controllers\ERP\StockAuditController;

Route::get(
    '/erp/stock-audit',
    [StockAuditController::class, 'index']
);
use App\Http\Controllers\ERP\BusinessDashboardController;

Route::get(
    '/erp/business-dashboard',
    [BusinessDashboardController::class, 'index']
);
use App\Http\Controllers\ERP\AccountsPayableController;
use App\Http\Controllers\ERP\AccountsReceivableController;
use App\Http\Controllers\ERP\BalanceSheetController;

Route::get(
    '/erp/accounts-payable',
    [AccountsPayableController::class, 'index']
);
Route::get(
    '/erp/accounts-receivable',
    [AccountsReceivableController::class, 'index']
);
Route::get(
    '/erp/balance-sheet',
    [BalanceSheetController::class, 'index']
);
use App\Http\Controllers\ERP\InventoryValuationController;
use App\Http\Controllers\ERP\LowStockController;
use App\Http\Controllers\ERP\StockLedgerController;
use App\Http\Controllers\ERP\TopCustomerController;

Route::get(
    '/erp/stock-ledger',
    [StockLedgerController::class, 'index']
);
Route::get(
    '/erp/inventory-valuation',
    [InventoryValuationController::class, 'index']
);
Route::get(
    '/erp/top-customers',
    [TopCustomerController::class, 'index']
);
Route::get(
    '/erp/low-stock',
    [LowStockController::class, 'index']
);

use App\Http\Controllers\ERP\CashReportController;
use App\Http\Controllers\ERP\PurchaseReportController;
use App\Http\Controllers\ERP\SalesReportController;

Route::get(
    '/erp/reports/sales',
    [SalesReportController::class, 'index']
);
Route::get(
    '/erp/reports/purchases',
    [PurchaseReportController::class, 'index']
);
Route::get(
    '/erp/reports/stock',
    [StockReportController::class, 'index']
);
Route::get(
    '/erp/reports/cash',
    [CashReportController::class, 'index']
);
use App\Http\Controllers\ERP\PermissionController;
use App\Http\Controllers\ERP\RoleController;

Route::get(
    '/erp/roles',
    [RoleController::class, 'index']
);
Route::get(
    '/erp/permissions',
    [PermissionController::class, 'index']
);
use App\Http\Controllers\ERP\UserController;
use App\Http\Controllers\ERP\UserCreateController;
use App\Http\Controllers\ERP\UserRoleController;

Route::get(
    '/erp/users',
    [UserController::class, 'index']
);
Route::post(
    '/erp/users',
    [UserCreateController::class, 'store']
);
Route::get(
    '/erp/user-roles',
    [UserRoleController::class, 'index']
);

use App\Http\Controllers\Accounting\AccountController;
use App\Http\Controllers\Accounting\LedgerController;

Route::get(
    '/erp/accounts',
    [AccountController::class, 'index']
);
Route::get(
    '/erp/ledger',
    [LedgerController::class, 'index']
);
use App\Http\Controllers\Accounting\TrialBalanceController;

Route::get(
    '/erp/trial-balance',
    [TrialBalanceController::class, 'index']
);

use App\Http\Controllers\Accounting\PeriodClosingController;

Route::get(
    '/erp/period-closing',
    [PeriodClosingController::class, 'index']
);
Route::post(
    '/erp/period-closing',
    [PeriodClosingController::class, 'store']
);
use App\Http\Controllers\ERP\AgingController;

Route::get(
    '/erp/aging-receivable',
    [AgingController::class, 'receivable']
);
Route::get(
    '/erp/aging-payable',
    [AgingController::class, 'payable']
);
use App\Http\Controllers\Accounting\FixedAssetController;

Route::get(
    '/erp/fixed-assets',
    [FixedAssetController::class, 'index']
);
use App\Http\Controllers\Accounting\DepreciationController;

Route::get(
    '/erp/asset-depreciation',
    [DepreciationController::class, 'index']
);
use App\Http\Controllers\Accounting\FixedAssetProcessController;

Route::post('/erp/fixed-assets', [FixedAssetProcessController::class, 'create']);
Route::post('/erp/run-depreciation', [FixedAssetProcessController::class, 'runDepreciation']);
use App\Http\Controllers\ERP\AccountsPayableReportController;
use App\Http\Controllers\ERP\AccountsReceivableReportController;
use App\Http\Controllers\ERP\BudgetController;
use App\Http\Controllers\ERP\PurchaseRequestController;
use App\Http\Controllers\ERP\GoodsReceiptController;
use App\Http\Controllers\ERP\AssetMaintenanceController;
Route::get('/erp/ap-report',[AccountsPayableReportController::class,'index']);
Route::get('/erp/ar-report',[AccountsReceivableReportController::class,'index']);
Route::get('/erp/budgets',[BudgetController::class,'index']);
Route::get('/erp/purchase-requests',[PurchaseRequestController::class,'index']);
Route::get('/erp/goods-receipts',[GoodsReceiptController::class,'index']);
Route::get('/erp/asset-maintenance',[AssetMaintenanceController::class,'index']);
use App\Http\Controllers\ERP\SantriController;
use App\Http\Controllers\ERP\MusyrifController;
use App\Http\Controllers\ERP\AttendanceController;
use App\Http\Controllers\ERP\DonationController;
use App\Http\Controllers\ERP\CashAccountController;
use App\Http\Controllers\ERP\PayrollController;
use App\Http\Controllers\ERP\PondokDashboardController;
Route::get('/erp/santri',[SantriController::class,'index']);
Route::get('/erp/musyrif',[MusyrifController::class,'index']);
Route::get('/erp/attendance',[AttendanceController::class,'index']);
Route::get('/erp/donations',[DonationController::class,'index']);
Route::get('/erp/cash-accounts',[CashAccountController::class,'index']);
Route::get('/erp/payroll',[PayrollController::class,'index']);
Route::get('/erp/pondok-dashboard',[PondokDashboardController::class,'index']);
use App\Http\Controllers\ERP\ExecutiveDashboardController;
use App\Http\Controllers\ERP\CashBankController;
use App\Http\Controllers\ERP\InventoryKpiController;
use App\Http\Controllers\ERP\PurchaseKpiController;
use App\Http\Controllers\ERP\SalesKpiController;
use App\Http\Controllers\ERP\WorkshopReportController;
Route::get('/erp/executive-dashboard',[ExecutiveDashboardController::class,'index']);
Route::get('/erp/cash-bank',[CashBankController::class,'index']);
Route::get('/erp/inventory-kpi',[InventoryKpiController::class,'index']);
Route::get('/erp/purchase-kpi',[PurchaseKpiController::class,'index']);
Route::get('/erp/sales-kpi',[SalesKpiController::class,'index']);
Route::get('/erp/workshop-report',[WorkshopReportController::class,'index']);
