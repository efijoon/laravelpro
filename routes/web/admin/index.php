<?php

use \Illuminate\Support\Facades\Route;

Route::get("/dashboard", function() {
   return view('admin.dashboard.index');
});

Route::prefix('users')->controller('UserController')->group(function () {
    Route::resource("/", 'UserController')->except('show');
    Route::get('/{user}/permissions', 'permissions');
    Route::put('/{user}/permissions', 'updatePermissions');
});

Route::resource("/permissions", 'PermissionController')->except('show');
Route::resource("/roles", 'RoleController')->except('show');
Route::resource("/products", 'ProductController')->except('show');
