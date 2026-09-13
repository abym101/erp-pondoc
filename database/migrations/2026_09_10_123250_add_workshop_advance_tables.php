<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('mechanic_id')
                ->nullable();
            $table->decimal(
                'profit',
                15,
                2
            )->default(0);
        });
        Schema::create(
            'work_order_services',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId(
                    'work_order_id'
                );
                $table->foreignId(
                    'service_job_id'
                );
                $table->decimal(
                    'price',
                    15,
                    2
                );
                $table->timestamps();
            }
        );
        Schema::create(
            'work_order_items',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId(
                    'work_order_id'
                );
                $table->foreignId(
                    'product_id'
                );
                $table->decimal(
                    'qty',
                    15,
                    2
                );
                $table->decimal(
                    'price',
                    15,
                    2
                );
                $table->decimal(
                    'subtotal',
                    15,
                    2
                );
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'work_order_items'
        );
        Schema::dropIfExists(
            'work_order_services'
        );
    }
};
