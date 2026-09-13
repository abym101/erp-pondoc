<?php

namespace Database\Seeders;

use App\Models\CashTransaction;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $supplier = Supplier::create([
            'name' => 'Supplier Oli',
            'phone' => '08123456789',
            'address' => 'Jakarta',
        ]);

        $product = Product::first();

        $purchase = Purchase::create([
            'supplier_id' => $supplier->id,
            'invoice_no' => 'PO001',
            'grand_total' => 450000,
            'payment_status' => 'UNPAID',
        ]);

        PurchaseItem::create([
            'purchase_id' => $purchase->id,
            'product_id' => $product->id,
            'qty' => 10,
            'price' => 45000,
            'subtotal' => 450000,
        ]);

        $product->stock += 10;
        $product->save();

        StockMovement::create([
            'product_id' => $product->id,
            'type' => 'IN-PO',
            'qty' => 10,
        ]);

        $customer = Customer::first();
        $vehicle = Vehicle::first();

        WorkOrder::create([
            'customer_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'number' => 'WO001',
            'status' => 'DONE',
            'complaint' => 'Ganti Oli',
        ]);

        $sale = Sale::create([
            'invoice_no' => 'INV001',
            'customer_id' => $customer->id,
            'grand_total' => 75000,
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'qty' => 1,
            'price' => 75000,
            'subtotal' => 75000,
        ]);

        CashTransaction::create([
            'trx_date' => now()->toDateString(),
            'type' => 'IN',
            'category' => 'SERVICE',
            'description' => 'Pendapatan WO',
            'amount' => 75000,
        ]);

        CashTransaction::create([
            'trx_date' => now()->toDateString(),
            'type' => 'OUT',
            'category' => 'OPERASIONAL',
            'description' => 'Beli Kopi',
            'amount' => 10000,
        ]);

        echo PHP_EOL;
        echo '=== ERP TEST DATA CREATED ==='.PHP_EOL;
    }
}
