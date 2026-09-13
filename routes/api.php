<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Inventory\CategoryController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\POS\SaleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Workshop\CustomerController;
use App\Http\Controllers\Workshop\VehicleController;
use App\Http\Controllers\Workshop\WorkOrderController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('vehicles', VehicleController::class);
Route::apiResource('work-orders', WorkOrderController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/reports/sales', [ReportController::class, 'sales']);
Route::get('/reports/stocks', [ReportController::class, 'stocks']);
Route::get('/reports/workorders', [ReportController::class, 'workorders']);
Route::get('/reports/invoice/{sale}', [ReportController::class, 'invoice']);
require __DIR__.'/auth.php';
use App\Http\Controllers\Auth\LoginController;

Route::post(
    '/login',
    [LoginController::class, 'login']
);
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get(
            '/me',
            [LoginController::class, 'me']
        );
        Route::post(
            '/logout',
            [LoginController::class, 'logout']
        );
    });

use App\Http\Controllers\ERP\PaymentController;

Route::post(
    '/payments',
    [PaymentController::class, 'store']
);

use App\Http\Controllers\ERP\SupplierPaymentController;

Route::post(
    '/supplier-payments',
    [SupplierPaymentController::class, 'store']
);
