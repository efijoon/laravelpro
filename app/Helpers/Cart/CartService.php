<?php

namespace App\Helpers\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartService
{
  protected $cart;

  public function __construct()
  {
    $this->cart = session()->get('cart') ?? collect([]);
  }

  public function add($data, $obj = null)
  {
    if(! is_null($obj) && $obj instanceof Model) {
      $data = array_merge($data, [
        'id' => Str::random(12),
        'subject_id' => $obj->id,
        'subject_type' => get_class($obj)
      ]);
    }

    $this->cart->put($data['id'], $data);
    session()->put('cart', $this->cart);
  }
}
