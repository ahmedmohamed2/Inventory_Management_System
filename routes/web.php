<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/auth/logout", [AuthController::class, "logout"]);
Route::post("/auth/check", [AuthController::class, "check"]);



Route::group(["middleware" => ["AuthCheck"]], function() {
    Route::get("/login", [AuthController::class, "login"]);
    Route::get("/", [MainController::class, "index"]);
    Route::get("/get_brands/{id}", [BrandsController::class, "get_brands"]);
    Route::get("/units/all", [UnitsController::class, "allData"]);

    Route::get("orders", [OrdersController::class, "index"]);
    Route::get("/orders/create", [OrdersController::class, "create"]);
    Route::get("/orders/details/{id}", [OrdersController::class, "orderDetails"]);
    Route::get("/orders/invoice/{id}", [OrdersController::class, "printInvoice"]);

    Route::get("/profile", [ProfileController::class, "profilePage"]);

    Route::get("/changepassword", [ProfileController::class, "changePasswordPage"]);

    Route::post("/profile/changePassword", [ProfileController::class, "changePassword"]);

    Route::post("orders", [OrdersController::class, "store"]);
    
    Route::post("/units/store", [UnitsController::class, "store"]);
    
    Route::resource('users', UsersController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('brands', BrandsController::class);
    Route::resource('products', ProductsController::class);    

});

