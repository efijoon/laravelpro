<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix("/:auth/")->namespace("Auth")->middleware(["guest", 'custome'])->group(function () {
    Route::get("/google", "GoogleAuthController@redirect")->name("auth.google");
    Route::get("/google/callback", "GoogleAuthController@callback");

    Route::get("/2fa", "TwoFactorController@show2Fa");
    Route::post("/2fa", "TwoFactorController@verify2Fa");
});

Route::get('/home', "HomeController@index")->name('home');

Route::prefix("/profile")->controller("ProfileController")->middleware("auth")->group(function () {
    Route::get("", "index")->name("showProfile");
    Route::get("/twoFactor", "twoFactor")->name("showTwoFactorAuthSettings");
    Route::post("/changeTwoFactor", "changeTwoFactor")->name("changeTwoFactorSettings");
    Route::get("/verify-phone-number", "showVerifyPhonePage");
    Route::post("/verify-phone-number", "verifyPhoneNumber");
});
