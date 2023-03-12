<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\{
    AuthController,
    UserController,
    WishlistController,
    ProductController,
    AdminController,
    PromoController
};

use \App\Http\Controllers\Socialite\{
    GoogleSocialiteController,
    FacebookSocialiteController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware("guest")->group(function() {
    Route::get("login", [AuthController::class, "login"])->name("login");
    Route::get("register", [AuthController::class, "register"])->name("register");
    Route::post("attempt-register", [AuthController::class, "attemptRegister"])->name("attempt-register");
    Route::post("attempt-login", [AuthController::class, "attemptLogin"])->name("attempt-login");

    Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name("google-login");
    Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

    Route::get('auth/facebook', [FacebookSocialiteController::class, 'facebookRedirect'])->name("facebook-login");
    Route::get('auth/facebook/callback', [FacebookSocialiteController::class, 'loginWithFacebook']);
});


Route::middleware("auth")->group(function() {
    Route::get("logout", [AuthController::class, "logout"])->name("logout");

    Route::middleware("can:user")->group(function() {
        Route::get("user", [UserController::class, "index"])->name("user.index");
        Route::get("user/detail-product/{product}", [UserController::class, "detailProduct"])->name("user.detail-product");
        Route::resource("wishlist", WishlistController::class);
        Route::get("profile", [UserController::class, "profile"])->name("user.profile");
        Route::get("user/edit", [UserController::class, "editUser"])->name("user.edit");
        Route::put("user/update", [UserController::class, "updateUser"])->name("user.update");
        Route::delete("user/delete", [UserController::class, "destroyUser"])->name("user.destroy");
    });

    Route::middleware("can:admin")->group(function() {
        Route::get("admin", [AdminController::class, "index"])->name("admin.index");
        Route::resource("promo", PromoController::class);

    });

    Route::resource("product", ProductController::class);
});
