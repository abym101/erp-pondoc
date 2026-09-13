<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            if (! Schema::hasColumn('work_orders', 'diagnosis')) {
                $table->text('diagnosis')->nullable();
            }
            if (! Schema::hasColumn('work_orders', 'service_cost')) {
                $table->decimal('service_cost', 15, 2)->default(0);
            }
            if (! Schema::hasColumn('work_orders', 'sparepart_cost')) {
                $table->decimal('sparepart_cost', 15, 2)->default(0);
            }
            if (! Schema::hasColumn('work_orders', 'total')) {
                $table->decimal('total', 15, 2)->default(0);
            }
        });
    }

    public function down(): void {}
};
