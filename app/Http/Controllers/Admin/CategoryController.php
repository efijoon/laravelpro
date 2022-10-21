<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::whereParent(null)->latest()->paginate(20);

    return view('admin.categories.index', compact('categories'));
  }

  public function create()
  {
    return view('admin.categories.create');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|min:3|unique:categories',
    ], [
      'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
    ]);

    if ($request->parent) {
      $request->validate([
        'parent' => 'exists:categories,id',
      ]);
    }

    Category::create([
      'name' => $data['name'],
      'parent' => $request->parent ?? null
    ]);

    return back();
  }

  public function edit(Category $category)
  {
    return view('admin.categories.edit', compact('category'));
  }

  public function update(Request $request, Category $category)
  {
    $data = $request->validate([
      'name' => ['required', Rule::unique('categories')->ignore($category->id)],
    ], [
      'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
    ]);

    if ($request->parent) {
      $request->validate([
        'parent' => 'exists:categories,id',
      ]);
    }

    $category->update([
      'name' => $data['name'],
      'parent' => $request->parent ?? null
    ]);

    return back();
  }

  public function destroy(Category $category)
  {
    $category->delete();

    return back();
  }
}
