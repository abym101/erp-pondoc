<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('payment_status')
                ->default('PAID')
                ->after('grand_total');
            $table->decimal(
                'paid_amount',
                18,
                2
            )->default(0)
                ->after('payment_status');
            $table->date('due_date')
                ->nullable()
                ->after('paid_amount');
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'paid_amount',
                'due_date',
            ]);
        });
    }
};
