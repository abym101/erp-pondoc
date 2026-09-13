<?php

namespace App\Services;

use App\Models\CashTransaction;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function create(
        $customerId,
        $productId,
        $qty,
        $price
    ) {
        return DB::transaction(function () use (
            $customerId,
            $productId,
            $qty,
            $price
        ) {
            $product =
                Product::findOrFail(
                    $productId
                );
            if (
                $product->stock < $qty
            ) {
                throw new \Exception(
                    'Stock tidak cukup'
                );
            }
            $total =
                $qty * $price;
            $sale =
                Sale::create([
                    'invoice_no' => 'INV-'.date('YmdHis'),
                    'customer_id' => $customerId,
                    'grand_total' => $total,
                ]);
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $total,
            ]);
            $product->decrement(
                'stock',
                $qty
            );
            StockMovement::create([
                'product_id' => $productId,
                'type' => 'OUT-SALE',
                'qty' => $qty,
            ]);
            CashTransaction::create([
                'trx_date' => date('Y-m-d'),
                'type' => 'IN',
                'category' => 'SALE',
                'description' => $sale->invoice_no,
                'amount' => $total,
            ]);
            AccountingService::postSale(
                $total,
                $sale->invoice_no
            );

            return $sale;
        });
    }
}
