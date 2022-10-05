<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if($keyword = $request->search) {
            $products->where('name', 'LIKE', "%$keyword%");
        }

        $products = $products->latest()->paginate(20)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'unique:products'],
            'desc' => ['required'],
            'stock' => ['required', 'numeric', 'min:0']
        ]);

        auth()->user()->products()->create([
            ...$data,
            'image' => 'test.png'
        ]);

        alert()->success('موفق', 'محصول با موفقیت ایجاد شد.');
        return back();
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('products')->ignore($product->id)],
            'desc' => ['required'],
            'stock' => ['required', 'numeric', 'min:0']
        ]);

        $product->update([
            ...$data,
            'user_id' => auth()->user()->id,
            'image' => 'test.png'
        ]);

        alert()->success('موفق', 'محصول با موفقیت ویرایش شد.');
        return back();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back();
    }
}
