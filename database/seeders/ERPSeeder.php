<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ERPSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'SuperAdmin']);
        Role::firstOrCreate(['name' => 'Kasir']);
        Role::firstOrCreate(['name' => 'Mekanik']);
        Role::firstOrCreate(['name' => 'Gudang']);
        $admin = User::updateOrCreate(
            ['email' => 'admin@erp.local'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('SuperAdmin');
        $oli = Category::firstOrCreate([
            'name' => 'Oli',
        ]);
        $sparepart = Category::firstOrCreate([
            'name' => 'Sparepart',
        ]);
        Product::firstOrCreate(
            ['sku' => 'OLI-001'],
            [
                'name' => 'Oli MPX',
                'category_id' => $oli->id,
                'purchase_price' => 45000,
                'selling_price' => 60000,
                'stock' => 100,
            ]
        );
        Product::firstOrCreate(
            ['sku' => 'BUSI-001'],
            [
                'name' => 'Busi NGK',
                'category_id' => $sparepart->id,
                'purchase_price' => 12000,
                'selling_price' => 18000,
                'stock' => 50,
            ]
        );
        $customer = Customer::firstOrCreate(
            ['phone' => '08123456789'],
            [
                'name' => 'Pelanggan Demo',
            ]
        );
        Vehicle::firstOrCreate(
            ['plate_number' => 'B1234ERP'],
            [
                'customer_id' => $customer->id,
                'brand' => 'Honda',
                'model' => 'Beat',
            ]
        );
    }
}
