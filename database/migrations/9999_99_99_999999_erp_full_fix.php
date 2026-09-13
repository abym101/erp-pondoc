<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (
            ! Schema::hasColumn(
                'payments',
                'posting_date'
            )
        ) {
            Schema::table(
                'payments',
                function (Blueprint $table) {
                    $table->date('posting_date')
                        ->nullable();
                }
            );
        }
        if (
            ! Schema::hasColumn(
                'sales',
                'payment_status'
            )
        ) {
            Schema::table(
                'sales',
                function (Blueprint $table) {
                    $table->string('payment_status')
                        ->default('PAID');
                }
            );
        }
        if (
            ! Schema::hasColumn(
                'sales',
                'paid_amount'
            )
        ) {
            Schema::table(
                'sales',
                function (Blueprint $table) {
                    $table->decimal(
                        'paid_amount',
                        18,
                        2
                    )->default(0);
                }
            );
        }
        if (
            ! Schema::hasColumn(
                'sales',
                'due_date'
            )
        ) {
            Schema::table(
                'sales',
                function (Blueprint $table) {
                    $table->date('due_date')
                        ->nullable();
                }
            );
        }
    }

    public function down(): void {}
};
