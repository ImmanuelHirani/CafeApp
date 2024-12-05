<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;


// FE
// Customer
Route::get('/', [CustomerController::class, 'index'])->name('template');
Route::post('/customer/register', [CustomerController::class, 'register'])->name('register');
Route::post('/customer/login', [CustomerController::class, 'login'])->name('login');
Route::post('/customer/logout', [CustomerController::class, 'logout'])->name('logout');

// frontend menu
Route::get('/menu', [MenuController::class, 'Product'])->name('frontend.menu');
Route::get('/menu/detail/{id}', [MenuController::class, 'getMenuDetails'])->name('frontend.menu.details');

// Order
Route::get('/cart', [OrderController::class, 'cartMenu'])->name('cart.view');
Route::put('/cart/update/{id}', [OrderController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/add', [OrderController::class, 'AddToCart'])->name('cart.add');
Route::get('/payment', [OrderController::class, 'payment'])->name('payment.view');
Route::delete('/cart/delete/{id}', [OrderController::class, 'deleteCart'])->name('delete.cart');


Route::get('/make-order', [OrderController::class, 'makeOrder'])->name('make.order');


Route::get('/Dashboard', function () {
    return view('Backend.Admin-Dashboard');
})->name('Dashboard');

// BE

// Admin Customer
Route::get('/Customer', [CustomerController::class, 'viewAdmin'])->name('customer.admin');
Route::get('/customer/detail/{id}', [CustomerController::class, 'getCustomerDetails'])->name('customer.details');

// Admin Product
Route::get('/admin/product', [MenuController::class, 'Product'])->name('admin.product');
Route::get('/admin/product/detail/{id}', [MenuController::class, 'getMenuDetails'])->name('menu.details');
Route::put('/update/product/{id}', [MenuController::class, 'updateMenu'])->name('update.menu');
Route::delete('/delete/product/{id}', [MenuController::class, 'deleteMenu'])->name('delete.menu');
Route::post('/create/product', [MenuController::class, 'NewMenu'])->name('create.new.product');
