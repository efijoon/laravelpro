<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
  public function getValues(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string'
    ]);

    $attr = Attribute::whereName($data['name'])->first();
    if(! $attr) return response([]);

    return response(['data' => $attr->values->pluck('value')]);
  }
}
