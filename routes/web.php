<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeCarController;
use App\Http\Controllers\TypeWashController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
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

    Route::controller(TransactionController::class)->group(function(){
        Route::get("/transaction/print/{id}", "print")->name("transaction.print");
        Route::get("/transaction/scan/{tran}", "viewScan")->name("transaction.view_scan");
        Route::post("/transaction/scan", "scan")->name("transaction.scan");
    });

    Route::controller(TypeCarController::class)->group(function(){
        Route::get("/type-car/get-type-car", "getTypeCar")->name("type-car.get-type-car");
    });

    Route::controller(TypeWashController::class)->group(function(){
        Route::get("/type-wash/get-type-wash", "getTypeWash")->name("type-wash.get-type-wash");
    });

    Route::resource("user", UserController::class);
    Route::resource("transaction", TransactionController::class);
    Route::resource("type-car", TypeCarController::class);
    Route::resource("type-wash", TypeWashController::class);

});