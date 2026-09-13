<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\WorkOrder;
use App\Models\WorkOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrderItemController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $wo = WorkOrder::findOrFail(
                $request->work_order_id
            );
            $product = Product::findOrFail(
                $request->product_id
            );
            $qty = (float) $request->qty;
            $subtotal =
                $qty *
                $product->selling_price;
            WorkOrderItem::create([
                'work_order_id' => $wo->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $product->selling_price,
                'subtotal' => $subtotal,
            ]);
            $product->stock =
                $product->stock - $qty;
            $product->save();
            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'OUT-WO',
                'qty' => $qty,
            ]);
            $wo->sparepart_cost =
                WorkOrderItem::where(
                    'work_order_id',
                    $wo->id
                )->sum('subtotal');
            $wo->total =
                $wo->service_cost +
                $wo->sparepart_cost;
            $wo->profit =
                $wo->service_cost;
            $wo->save();
            DB::commit();

            return redirect(
                '/erp/work-orders'
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}
