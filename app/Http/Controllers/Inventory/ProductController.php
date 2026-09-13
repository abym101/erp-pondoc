<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view(
            'products.index',
            [
                'products' => Product::orderBy('name')
                    ->get(),
            ]
        );
    }

    public function store(Request $request)
    {
        Product::create([
            'sku' => $request->sku,
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock,
        ]);

        return redirect(
            '/erp/products'
        );
    }
}
