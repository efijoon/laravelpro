<?php

use \Illuminate\Support\Facades\Route;

Route::get("/dashboard", function() {
   return view('admin.dashboard.index');
});

Route::resource("/users", 'UserController')->except('show');
