<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeCarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('login');
// });

Route::controller(AuthController::class)->group(function(){
    Route::get("/", "login")->name("login");
    Route::post("/authentication", "authentication")->name("authentication");
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AuthController::class)->group(function(){
        Route::get("/logout", "logout")->name("logout");
    });

    Route::controller(HomeController::class)->group(function(){
        Route::get("/home", "index")->name("home");
    });

    Route::resource("user", UserController::class);
    Route::resource("type-car", TypeCarController::class);
});