<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'purchases',
            function (Blueprint $table) {
                if (
                    ! Schema::hasColumn(
                        'purchases',
                        'paid_amount'
                    )
                ) {
                    $table->decimal(
                        'paid_amount',
                        18,
                        2
                    )
                        ->default(0)
                        ->after('payment_status');
                }
                if (
                    ! Schema::hasColumn(
                        'purchases',
                        'due_date'
                    )
                ) {
                    $table->date(
                        'due_date'
                    )
                        ->nullable()
                        ->after('paid_amount');
                }
            }
        );
        Schema::create(
            'supplier_payments',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger(
                    'purchase_id'
                );
                $table->date(
                    'posting_date'
                );
                $table->decimal(
                    'amount',
                    18,
                    2
                );
                $table->string(
                    'method'
                );
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'supplier_payments'
        );
        Schema::table(
            'purchases',
            function (Blueprint $table) {
                if (
                    Schema::hasColumn(
                        'purchases',
                        'paid_amount'
                    )
                ) {
                    $table->dropColumn(
                        'paid_amount'
                    );
                }
                if (
                    Schema::hasColumn(
                        'purchases',
                        'due_date'
                    )
                ) {
                    $table->dropColumn(
                        'due_date'
                    );
                }
            }
        );
    }
};
