<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('migrations')
            ->where('migration', '2026_09_13_095809_create_roles_table')
            ->delete();
        DB::table('migrations')
            ->insertOrIgnore([
                'migration' => '2026_09_13_095809_create_roles_table',
                'batch' => 1,
            ]);
        DB::table('migrations')
            ->where('migration', '2026_09_13_095810_create_permissions_table')
            ->delete();
        DB::table('migrations')
            ->insertOrIgnore([
                'migration' => '2026_09_13_095810_create_permissions_table',
                'batch' => 1,
            ]);
    }

    public function down(): void {}
};
