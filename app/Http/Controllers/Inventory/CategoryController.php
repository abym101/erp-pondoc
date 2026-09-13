<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =
            Category::latest()->get();

        return view(
            'categories.index',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect(
            '/erp/categories'
        );
    }

    public function show(Category $category)
    {
        return view(
            'categories.show',
            compact('category')
        );
    }

    public function update(
        Request $request,
        Category $category
    ) {
        $category->update([
            'name' => $request->name,
        ]);

        return redirect(
            '/erp/categories'
        );
    }

    public function destroy(
        Category $category
    ) {
        $category->delete();

        return redirect(
            '/erp/categories'
        );
    }
}
