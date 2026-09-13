<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'product.view',
            'product.create',
            'product.update',
            'product.delete',
            'stock.view',
            'stock.create',
            'stock.update',
            'sale.view',
            'sale.create',
            'sale.update',
            'customer.view',
            'customer.create',
            'customer.update',
            'vehicle.view',
            'vehicle.create',
            'vehicle.update',
            'workorder.view',
            'workorder.create',
            'workorder.update',
            'report.view',
            'user.manage',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $kasir = Role::firstOrCreate(['name' => 'Kasir']);
        $mekanik = Role::firstOrCreate(['name' => 'Mekanik']);
        $owner = Role::firstOrCreate(['name' => 'Owner']);
        $admin->syncPermissions(Permission::all());
        $kasir->syncPermissions([
            'sale.view',
            'sale.create',
            'customer.view',
            'customer.create',
            'product.view',
        ]);
        $mekanik->syncPermissions([
            'workorder.view',
            'workorder.create',
            'workorder.update',
            'vehicle.view',
            'vehicle.create',
        ]);
        $owner->syncPermissions([
            'report.view',
        ]);
    }
}
