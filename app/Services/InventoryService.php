<?php

namespace App\Services;

use DB;

class InventoryService
{
    public static function receive(
        int $productId,
        float $qty,
        float $unitCost,
        string $postingDate,
        string $trxType,
        string $description,
        ?int $sourceId = null
    ): void {
        DB::table(
            'inventory_layers'
        )->insert([
            'product_id' => $productId,
            'posting_date' => $postingDate,
            'qty_in' => $qty,
            'qty_remaining' => $qty,
            'unit_cost' => $unitCost,
            'source_type' => $trxType,
            'source_id' => $sourceId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table(
            'inventory_ledger'
        )->insert([
            'product_id' => $productId,
            'posting_date' => $postingDate,
            'trx_type' => $trxType,
            'qty_in' => $qty,
            'qty_out' => 0,
            'unit_cost' => $unitCost,
            'total_cost' => $qty * $unitCost,
            'description' => $description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('products')
            ->where('id', $productId)
            ->increment('stock', $qty);
    }

    public static function issue(
        int $productId,
        float $qty,
        string $postingDate,
        string $trxType,
        string $description
    ): float {
        $remaining = $qty;
        $totalCost = 0;
        $layers =
        DB::table(
            'inventory_layers'
        )
            ->where(
                'product_id',
                $productId
            )
            ->where(
                'qty_remaining',
                '>',
                0
            )
            ->orderBy('id')
            ->lockForUpdate()
            ->get();
        foreach ($layers as $layer) {
            if ($remaining <= 0) {
                break;
            }
            $take =
            min(
                $remaining,
                $layer->qty_remaining
            );
            DB::table(
                'inventory_layers'
            )
                ->where(
                    'id',
                    $layer->id
                )
                ->update([
                    'qty_remaining' => $layer->qty_remaining - $take,
                ]);
            $cost =
            $take *
            $layer->unit_cost;
            $totalCost += $cost;
            DB::table(
                'inventory_ledger'
            )->insert([
                'product_id' => $productId,
                'posting_date' => $postingDate,
                'trx_type' => $trxType,
                'qty_in' => 0,
                'qty_out' => $take,
                'unit_cost' => $layer->unit_cost,
                'total_cost' => $cost,
                'description' => $description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $remaining -= $take;
        }
        if ($remaining > 0) {
            throw new \Exception(
                'INSUFFICIENT STOCK FIFO'
            );
        }
        DB::table('products')
            ->where('id', $productId)
            ->decrement('stock', $qty);

        return $totalCost;
    }
}
