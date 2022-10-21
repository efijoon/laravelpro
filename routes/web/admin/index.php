<?php

use \Illuminate\Support\Facades\Route;

Route::get("/dashboard", function() {
   return view('admin.dashboard.index');
});

Route::resource("/users", 'UserController')->except('show');
Route::prefix('/users')->controller('UserController')->group(function () {
    Route::get('/{user}/permissions', 'permissions');
    Route::put('/{user}/permissions', 'updatePermissions');
});

Route::resource("/permissions", 'PermissionController')->except('show');
Route::resource("/roles", 'RoleController')->except('show');
Route::resource("/products", 'ProductController')->except('show');
Route::resource("/comments", 'CommentController')->except('show', 'create', 'store');
Route::resource("/categories", 'CategoryController')->except('show');

Route::post("/attributes/getValues", 'AttributeController@getValues');
