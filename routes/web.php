<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CardProduct;
use Livewire\Livewire;

Auth::routes(['register' => false]);

Livewire::component('card-product', CardProduct::class);

Route::post('/newsletters/subscribe', 'NewsletterController@store')->name('newsletters.subscribe');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/buy-products', 'ClientController@shopProducts')->name('buy.products');
Route::get('/products/{product}/details-view', 'ClientController@productDetails')->name('products.details-view');

Route::get('/addToCart/{id}', ['uses' => 'CartController@getAddToCart', 'as' => 'cart.addToCart']);
Route::get('/shoppingCart', ['uses' => 'CartController@getShoppingCart', 'as' => 'cart.shoppingCart']);

Route::get('/remove/cart/item/{id}', [
    'uses' => 'CartController@getRemoveItem',
    'as' => 'cart.removeItem',
]);
Route::get('/remove/cart', [
    'uses' => 'CartController@getRemoveAll',
    'as' => 'cart.removeAll',
]);

Route::get('/increment/cart/item/{id}', [
    'uses' => 'CartController@getIncrement',
    'as' => 'cart.increment',
]);

Route::get('/decrement/cart/item/{id}', [
    'uses' => 'CartController@getDecrement',
    'as' => 'cart.decrement',
]);

Route::group(['prefix' => 'customer'], function () {
    Route::get('/check-out', [
        'uses' => 'CartController@checkOut',
        'as' => 'cart.get.checkout',
    ]);

    Route::post('/check-out', [
        'uses' => 'CartController@postCheckOut',
        'as' => 'cart.checkOut',
    ]);

    Route::get('/order-success/{id}', 'OrderController@orderSuccess')->name('order.success');
});

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventController');

    // Newsletter
    Route::delete('newsletters/destroy', 'NewsletterController@massDestroy')->name('newsletters.massDestroy');
    Route::resource('newsletters', 'NewsletterController');

    // Shop
    Route::delete('shops/destroy', 'SettingController@massDestroy')->name('shops.massDestroy');
    Route::post('shops/media', 'SettingController@storeMedia')->name('shops.storeMedia');
    Route::post('shops/ckmedia', 'SettingController@storeCKEditorImages')->name('shops.storeCKEditorImages');
    Route::resource('shops', 'SettingController');

    // Home Slide
    Route::delete('home-slides/destroy', 'HomeSlideController@massDestroy')->name('home-slides.massDestroy');
    Route::post('home-slides/media', 'HomeSlideController@storeMedia')->name('home-slides.storeMedia');
    Route::post('home-slides/ckmedia', 'HomeSlideController@storeCKEditorImages')->name('home-slides.storeCKEditorImages');
    Route::resource('home-slides', 'HomeSlideController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
