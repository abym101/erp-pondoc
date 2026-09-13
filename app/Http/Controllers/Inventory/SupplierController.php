<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::orderBy('name')->get();
    }

    public function store()
    {
        return Supplier::create([
            'name' => 'Supplier Oli',
            'phone' => '08123456789',
            'address' => 'Jakarta',
        ]);
    }
}
