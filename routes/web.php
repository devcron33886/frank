<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeSlideController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Livewire\CardProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Auth::routes(['register' => false]);

Livewire::component('card-product', CardProduct::class);

Route::post('/newsletters/subscribe', [NewsletterController::class, 'store'])->name('newsletters.subscribe');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/buy-products', [ClientController::class, 'shopProducts'])->name('buy.products');
Route::get('/products/{product}/details-view', [ClientController::class, 'productDetails'])->name('products.details-view');

Route::get('/addToCart/{id}', [CartController::class, 'getAddToCart'])->name('cart.addToCart');
Route::get('/shoppingCart', [CartController::class, 'getShoppingCart'])->name('cart.shoppingCart');
Route::get('/remove/cart/item/{id}', [CartController::class, 'getRemoveItem'])->name('cart.removeItem');
Route::get('/remove/cart', [CartController::class, 'getRemoveAll'])->name('cart.removeAll');

Route::get('/increment/cart/item/{id}', [CartController::class, 'getIncrement'])->name('cart.increment');

Route::get('/decrement/cart/item/{id}', [CartController::class, 'getDecrement'])->name('cart.decrement');

Route::group(['prefix' => 'customer'], function () {
    Route::get('/check-out', [CartController::class, 'checkOut'])->name('cart.get.checkout');
    Route::post('/check-out', [CartController::class, 'postCheckOut'])->name('cart.checkOut');
    Route::get('/order-success/{id}', [OrderController::class, 'orderSuccess'])->name('order.success');
});

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Category
    Route::delete('categories/destroy', [CategoryController::class, 'massDestroy'])->name('categories.massDestroy');
    Route::resource('categories', CategoryController::class);

    // Product
    Route::delete('products/destroy', [ProductController::class, 'massDestroy'])->name('products.massDestroy');
    Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::post('products/ckmedia', [ProductController::class, 'storeCKEditorImages'])->name('products.storeCKEditorImages');
    Route::resource('products', ProductController::class);

    // Event
    Route::delete('events/destroy', [EventController::class, 'massDestroy'])->name('events.massDestroy');
    Route::resource('events', EventController::class);

    // Newsletter
    Route::delete('newsletters/destroy', [\App\Http\Controllers\Admin\NewsletterController::class, 'massDestroy'])->name('newsletters.massDestroy');
    Route::resource('newsletters', \App\Http\Controllers\Admin\NewsletterController::class);

    // Shop
    Route::delete('shops/destroy', [SettingController::class, 'massDestroy'])->name('shops.massDestroy');
    Route::post('shops/media', [SettingController::class, 'storeMedia'])->name('shops.storeMedia');
    Route::post('shops/ckmedia', [SettingController::class, 'storeCKEditorImages'])->name('shops.storeCKEditorImages');
    Route::resource('shops', SettingController::class);

    // Home Slide
    Route::delete('home-slides/destroy', [HomeSlideController::class, 'massDestroy'])->name('home-slides.massDestroy');
    Route::post('home-slides/media', [HomeSlideController::class, 'storeMedia'])->name('home-slides.storeMedia');
    Route::post('home-slides/ckmedia', [HomeSlideController::class, 'storeCKEditorImages'])->name('home-slides.storeCKEditorImages');
    Route::resource('home-slides', HomeSlideController::class);

    // Order
    Route::delete('orders/destroy', [\App\Http\Controllers\Admin\OrderController::class, 'massDestroy'])->name('orders.massDestroy');
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
