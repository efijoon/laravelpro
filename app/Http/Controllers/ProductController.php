<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(20);

        return view('products.index', compact('products'));
    }

    public function view(Product $product)
    {
        return view('products.view', compact('product'));
    }
}
