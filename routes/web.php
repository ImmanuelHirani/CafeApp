<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\contactUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
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
Route::get('/menu/detail/{id}/{size?}', [MenuController::class, 'getMenuDetails'])->name('frontend.menu.details');


// Custom Order
Route::get('/menu/custom', [CustomerOrderController::class, 'customPizza'])->name('frontend.menu.custom');

// Cart
Route::get('/cart', [CartController::class, 'cartMenu'])->name('cart.view');
Route::put('/cart/update/{tempID}', [CartController::class, 'updateCartQuantity'])->name('cart.update');
Route::delete('/cart/delete/{tempID}', [CartController::class, 'deleteCart'])->name('delete.cart');
Route::post('/cart/add', [CartController::class, 'AddToCart'])->name('cart.add');


// Order
Route::get('/payment', [OrderController::class, 'payment'])->name('payment.view');
Route::get('/tracking/order', [OrderController::class, 'trackOrder'])->name('tracking.view');
Route::get('/make-order', [OrderController::class, 'makeOrder'])->name('make.order');

// Contact US
Route::get('/contact', [contactUsController::class, 'contactUS'])->name('contact.view');


Route::get('/Dashboard', function () {
    return view('Backend.Admin-Dashboard');
})->name('Dashboard');

// BE

// Admin Customer
Route::get('/Customer', [CustomerController::class, 'viewAdmin'])->name('customer.admin');
Route::get('/customer/detail/{id}', [CustomerController::class, 'getCustomerDetails'])->name('customer.details');

// Admin Product
Route::get('/admin/product', [MenuController::class, 'Product'])->name('admin.product');
Route::get('/admin/product/detail/{id}', [MenuController::class, 'getMenuDetails'])->name('admin.product.detail');

// Route untuk update ukuran menu


Route::put('/update/product/{id}', [MenuController::class, 'updateMenu'])->name('update.menu');
Route::delete('/delete/product/{id}', [MenuController::class, 'deleteMenu'])->name('delete.menu');
Route::post('/create/product', [MenuController::class, 'NewMenu'])->name('create.new.product');
