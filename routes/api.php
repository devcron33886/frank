<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Event
    Route::apiResource('events', 'EventApiController');

    // Newsletter
    Route::apiResource('newsletters', 'NewsletterApiController');

    // Shop
    Route::post('shops/media', 'ShopApiController@storeMedia')->name('shops.storeMedia');
    Route::apiResource('shops', 'ShopApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');
});
