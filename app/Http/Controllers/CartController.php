<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function add(Product $product)
  {
//    return session()->get('cart');
    Cart::add([
      'quantity' => 1,
      'price' => $product->price
    ], $product);

    return 'ok';
  }
}
