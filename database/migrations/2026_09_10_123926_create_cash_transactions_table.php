<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'cash_transactions',
            function (Blueprint $table) {
                $table->id();
                $table->date(
                    'trx_date'
                );
                $table->string(
                    'type'
                );
                $table->string(
                    'category'
                );
                $table->string(
                    'description'
                )->nullable();
                $table->decimal(
                    'amount',
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
            'cash_transactions'
        );
    }
};
