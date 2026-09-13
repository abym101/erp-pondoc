<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function create(
        $supplierId,
        $productId,
        $qty,
        $price
    ) {
        return DB::transaction(function () use (
            $supplierId,
            $productId,
            $qty,
            $price
        ) {
            $total =
                $qty * $price;
            $purchase =
                Purchase::create([
                    'supplier_id' => $supplierId,
                    'invoice_no' => 'PO-'.date('YmdHis'),
                    'grand_total' => $total,
                    'payment_status' => 'UNPAID',
                ]);
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $productId,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $total,
            ]);
            Product::findOrFail(
                $productId
            )->increment(
                'stock',
                $qty
            );
            StockMovement::create([
                'product_id' => $productId,
                'type' => 'IN-PO',
                'qty' => $qty,
            ]);
            AccountingService::postPurchase(
                $total,
                $purchase->invoice_no
            );

            return $purchase;
        });
    }
}
