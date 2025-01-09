<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\contactUsController;
use App\Http\Controllers\CustomCategoriesController;
use App\Http\Controllers\customer_message;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\userController;

// FE
// Customer
Route::get('/', [UserController::class, 'index'])->name('template');
Route::post('/customer/register', [UserController::class, 'Register'])->name('register');
Route::post('/admin/register', [UserController::class, 'RegisterAdmin'])->name('register.admin');
Route::post('/customer/login', [UserController::class, 'loginUser'])->name('login');
Route::post('/admin/login', [UserController::class, 'loginAdmin'])->name('login.admin');
Route::post('/customer/logout', [UserController::class, 'logoutUser'])->name('logout');
Route::post('/admin/logout', [UserController::class, 'logoutAdmin'])->name('logout.admin');
Route::post('/customer/status/update/{customerID}', [UserController::class, 'updateStatus'])->name('customer.updateStatus');

// frontend menu
Route::get('/menu', [MenuController::class, 'Product'])->name('frontend.menu');
Route::get('/menu/detail/{id}/{size?}', [MenuController::class, 'getMenuDetails'])->name('frontend.menu.details');
Route::post('/favorite-menu/add', [MenuController::class, 'addToFav'])->name('favorite.menu.addremove');
Route::delete('/favorite-menu/remove/{menuID}', [profileController::class, 'removeToFav']);
Route::delete('/favorite-menu/clear-all', [profileController::class, 'clearAllFavorites']);
Route::post('/menu-reviews', [MenuController::class, 'storeReview'])->name('menu.reviews.store');
Route::delete('/menu-reviews/delete/{reviewID}', [MenuController::class, 'deleteReview'])->name('menu.reviews.delete');






// Profile
Route::get('/profile', [profileController::class, 'profile'])->name('frontend.profile');
Route::put('/profile/update/{user_ID}', [UserController::class, 'updateuser'])->name('profile.update');
Route::put('/admin/update/{userID}', [UserController::class, 'updateAdmin'])->name('admin.profile.update');

Route::post('/profile/location/add', [LocationController::class, 'addLocation'])->name('profile.location.add');
Route::delete('/profile/location/delete/{locationID}', [LocationController::class, 'deleteLocation'])->name('profile.location.delete');
Route::put('/profile/location/update/primary/{locationID}', [LocationController::class, 'updatePrimary'])->name('profile.location.primary');
Route::put('/profile/location/update/{locationID}', [LocationController::class, 'updateLocation'])->name('profile.location.update');

Route::get('/profile/location/update/{locationId}', [LocationController::class, 'getLocationData'])->name('profile.location.detail');

// Custom Order
Route::get('/menu/custom', [CustomerOrderController::class, 'customPizza'])->name('frontend.menu.custom');
Route::post('/custom-categories/store', [CustomCategoriesController::class, 'store'])->name('custom.categories.store');
Route::delete('admin/menu/custom/delete/{id}', [CustomCategoriesController::class, 'delete'])->name('custom.categories.delete');
Route::get('admin/menu/custom/details/{id}', [CustomCategoriesController::class, 'getCategoriesDetails'])->name('custom.categories.details');
Route::post('/update-properties', [CustomCategoriesController::class, 'updateProperties'])->name('update.properties');
Route::post('/custom-properties/{id}/insert', [CustomCategoriesController::class, 'storeProperties'])->name('custom.properties.store');
Route::post('/custom-categories/size/store', [CustomCategoriesController::class, 'storeSizeProperties'])
    ->name('custom.categories.size.store');
Route::post('/custom/catgories/status/update/{categoriesID}', [CustomCategoriesController::class, 'updateStatus'])->name('custom.updateStatus');
Route::post('/calculate-total', [CustomerOrderController::class, 'calculateTotal']);
// Route::get('/check-auth', [CustomerOrderController::class, 'checkAuth'])->name('check.auth');



// Cart
Route::get('/cart', [CartController::class, 'cartMenu'])->name('cart.view');
Route::put('/cart/update/{transactionID}', [CartController::class, 'updateCartQuantity'])->name('cart.update');
Route::delete('/cart/delete/{transactionID}', [CartController::class, 'deleteCart'])->name('delete.cart');
Route::post('/cart/add/', [CartController::class, 'AddToCart'])->name('cart.add');
Route::post('/store-custom-order', [CartController::class, 'AddToCartCustom'])->name('store.custom.order');
Route::get('/transaction_details/custom-details/{transactionID}', [CartController::class, 'getCustomDetails']);






// Order
Route::get('/payment', [OrderController::class, 'payment'])->name('payment.view');
Route::get('/order/details/{transactionID}', [OrderController::class, 'trackOrder'])->name('order-details.view');
Route::get('/make-order', [CartController::class, 'makeOrder'])->name('make.order');
Route::put('/order/cancel/{transactionID}', [CartController::class, 'cancelOrder'])->name('order.cancel');
Route::put('/order/pay/{transactionID}', [OrderController::class, 'payOrder'])->name('order.pay');
Route::post('/payment/get-transaction-token', [PaymentController::class, 'getTransactionToken']);


// Contact US
Route::get('/contact', [contactUsController::class, 'contactUS'])->name('contact.view');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('Dashboard.view');
Route::post('/customer-message', [customer_message::class, 'insertCS'])->name('insertCS');





// BE

// Admin Customer
Route::get('/Customer', [UserController::class, 'viewAdmin'])->name('customer.admin');
Route::get('/admin/profile', [profileController::class, 'profileAdmin'])->name('customer.profile');
Route::get('/Admin/User', [UserController::class, 'viewUser'])->name('admin.user');
Route::get('/Auth', [UserController::class, 'adminAuth'])->name('admin.auth');
Route::get('/customer/detail/{id}', [userController::class, 'getCustomerDetails'])->name('customer.details');


// Admin Contact Us CS
Route::get('/contactUS/CS/Admin', [contactUsController::class, 'CSAdmin']);

// Admin Product
Route::get('/admin/product', [MenuController::class, 'Product'])->name('admin.product');
Route::get('/admin/product/detail/{id}', [MenuController::class, 'getMenuDetails'])->name('admin.product.detail');

// Route untuk update ukuran menu
Route::get('/admin/menu/order', [OrderController::class, 'adminOrder'])->name('admin.order');
Route::get('/admin/menu/custom/order', [CustomCategoriesController::class, 'adminCustomOrder'])->name('admin.custom.order');
Route::get('/admin/menu/order/{id}', [OrderController::class, 'getCustomerOrderDetails'])->name('admin.order.details');
// Route untuk mengupdate status order
Route::post('/order/update-status/{transactionID}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');


Route::put('/update/product/{id}', [MenuController::class, 'updateMenu'])->name('update.menu');
Route::delete('/delete/product/{id}', [MenuController::class, 'deleteMenu'])->name('delete.menu');
Route::post('/create/product', [MenuController::class, 'NewMenu'])->name('create.new.product');
