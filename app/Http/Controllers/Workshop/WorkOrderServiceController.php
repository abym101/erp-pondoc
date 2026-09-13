<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\ServiceJob;
use App\Models\WorkOrder;
use App\Models\WorkOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrderServiceController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $wo = WorkOrder::findOrFail(
                $request->work_order_id
            );
            $service = ServiceJob::findOrFail(
                $request->service_job_id
            );
            WorkOrderService::create([
                'work_order_id' => $wo->id,
                'service_job_id' => $service->id,
                'price' => $service->price,
            ]);
            $serviceTotal =
                WorkOrderService::where(
                    'work_order_id',
                    $wo->id
                )->sum('price');
            $wo->service_cost =
                $serviceTotal;
            $wo->total =
                $wo->service_cost +
                $wo->sparepart_cost;
            $wo->profit =
                $wo->total;
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
