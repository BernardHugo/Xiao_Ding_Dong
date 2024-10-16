<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\MiddleWare\CheckLogin;
use App\Http\MiddleWare\ValidateRole;

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

// Authentication

Route::get('/', [AuthController::class, 'home']);
Route::get('/home', [AuthController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'logIn'])->name('login');
    Route::post('validate_login', [AuthController::class, 'validateLogin'])->name('login.validate'); 
    Route::get('/register', [AuthController::class, 'registration'])->name('register');
    Route::post('validate_register', [AuthController::class, 'validateRegister'])->name('register.validate');
});

Route::get('/sign_out', [AuthController::class, 'signOut'])->name('signout');

// Member only

Route::middleware('auth')->group(function () {
    Route::get('/search_food', [FoodController::class, 'searchFood'])->name('search_food');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/add_to_cart', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('order_checkout', [CartController::class, 'orderCheckout'])->name('order_checkout');
    Route::post('quantity/plus/{cart}', [CartController::class, 'plusQuantity'])->name('quantity.plus');
    Route::post('quantity/minus/{cart}', [CartController::class, 'minusQuantity'])->name('quantity.minus');
    Route::get('/transaction', [CartController::class, 'transactionHistory'])->name('transaction_history');
    Route::resource('/carts', CartController::class);
});

Route::get('/food_detail', [FoodController::class, 'foodDetail'])->name('food_detail');

// Admin only 

Route::middleware('admin')->group(function () {
    Route::get('/admin_home', [AuthController::class, 'admin'])->name('admin_home');
    Route::get('/admin_food_detail', [FoodController::class, 'adminFoodDetail'])->name('admin.food_detail');
    Route::get('/manage_food', [FoodController::class, 'manageFood'])->name('manage_food');
    Route::get('/add_food', [FoodController::class, 'addFood'])->name('add_food');
    Route::get('/edit_food/{id}', [FoodController::class, 'editFood'])->name('edit_food');
    Route::put('/update/{id}', [FoodController::class, 'update'])->name('foods.update');
    Route::post('store', [FoodController::class, 'storeFood'])->name('foods.store');
    Route::delete('foods/{id}', [FoodController::class, 'destroy'])->name('foods.destroy');
});

// Profile 

Route::middleware('auth')->group(function () {
    Route::get('view_profile', [ProfileController::class, 'viewProfile'])->name('view_profile');
    Route::get('edit_profile/{id}', [ProfileController::class, 'editProfile'])->name('edit_profile');
});

Route::middleware('admin')->group(function () {
    Route::get('admin_view_profile', [ProfileController::class, 'viewProfileAdmin'])->name('admin.view_profile');
    Route::get('admin_edit_profile/{id}', [ProfileController::class, 'editProfileAdmin'])->name('admin.edit_profile');
});

Route::post('save_profile/{id}', [ProfileController::class, 'saveProfile'])->name('save_profile');
Route::post('admin_save_profile/{id}', [ProfileController::class, 'saveProfileAdmin'])->name('admin.save_profile');