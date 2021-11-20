<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.form');

Route::middleware('Auth:web_admin')->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('account', 'AccountController@edit')->name('account.edit');
    Route::post('account', 'AccountController@update');
    Route::get('change-password', 'AccountController@editPassword')->name('password.edit');
    Route::post('change-password', 'AccountController@updatePassword');

    Route::get('customers', 'CustomerController@index')->name('customers');
    Route::get('customers/{customer}', 'CustomerController@edit')->name('customer.edit');
    Route::post('customers/{customer}', 'CustomerController@update');

    Route::get('users', 'UserController@index')->name('users');
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::post('users/create', 'UserController@store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::post('users/{user}/edit', 'UserController@update');
    Route::get('users/{user}/disable', 'UserController@disable')->name('user.disable');
    Route::get('users/{user}/active', 'UserController@active')->name('user.active');

    Route::get('address/find', 'AddressController@find')->name('address.find');

    Route::get('categories', 'CategoryController@index')->name('categories.list');
    Route::get('categories/create', 'CategoryController@create')->name('category.create');
    Route::post('categories/create', 'CategoryController@store');
    Route::get('categories/subcategories', 'CategoryController@subcategories')->name('category.subcategories');
    Route::get('categories/{category}', 'CategoryController@edit')->name('category.edit');
    Route::post('categories/{category}/remove', 'CategoryController@destroy')->name('category.remove');
    Route::post('categories/{category}', 'CategoryController@update');

    Route::get('subcategories', 'SubcategoryController@index')->name('subcategories.list');
    Route::get('subcategories/create', 'SubcategoryController@create')->name('subcategory.create');
    Route::post('subcategories/create', 'SubcategoryController@store');
    Route::get('subcategories/{subcategory}', 'SubcategoryController@edit')->name('subcategory.edit');
    Route::post('subcategories/{subcategory}/remove', 'SubcategoryController@destroy')->name('subcategory.remove');
    Route::post('subcategories/{subcategory}', 'SubcategoryController@update');

    Route::get('products', 'ProductController@index')->name('products.list');
    Route::get('products/create', 'ProductController@create')->name('product.create');
    Route::post('products/create', 'ProductController@store');
    Route::get('products/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::post('products/{product}/edit', 'ProductController@update');
    Route::get('products/{product}/images/{productImage}/remove', 'ProductController@removeImage')->name('product.image.remove');
    Route::get('products/{product}/images/{productImage}/main', 'ProductController@mainImage')->name('product.image.main');

    Route::get('products/{product}/variations/create', 'ProductVariationController@create')->name('variation.create');
    Route::post('products/{product}/variations/create', 'ProductVariationController@store');
    Route::get('products/{product}/variations/{productVariation}/edit', 'ProductVariationController@edit')->name('variation.edit');
    Route::post('products/{product}/variations/{productVariation}/edit', 'ProductVariationController@update');
    Route::get('products/{product}/variations/{productVariation}/remove', 'ProductVariationController@destroy')->name('variation.remove');
    Route::get('products/{product}/variations/{productVariation}/main', 'ProductVariationController@defineMain')->name('variation.main');
    Route::post('products/{product}/variations/{productVariation}/link-image', 'ProductVariationController@linkImage')->name('variation.linkImage');
    Route::post('products/{product}/variations/{productVariation}/unlink-image', 'ProductVariationController@unlinkImage')->name('variation.unlinkImage');
    Route::get('stocks', 'ProductVariationController@stockList')->name('stocks.list');

    Route::get('grids', 'GridController@index')->name('grids.list');
    Route::get('grids/create', 'GridController@create')->name('grid.create');
    Route::post('grids/create', 'GridController@store');
    Route::get('grids/{grid}', 'GridController@edit')->name('grid.edit');
    Route::put('grids/{grid}', 'GridController@update')->name('grid.update');
    Route::post('grids/{grid}/remove', 'GridController@destroy')->name('grid.remove');

    Route::post('grids/{grid}/variations', 'GridVariationController@store')->name('variation.store');
    Route::put('grids/{grid}/variations/{gridVariation}', 'GridVariationController@update')->name('variation.update');
    Route::post('grids/{grid}/variations/{gridVariation}/remove', 'GridVariationController@destroy')->name('variation.remove');

    Route::get('orders', 'OrderController@index')->name('orders.list');
    Route::get('orders/{order}', 'OrderController@show')->name('order.show');
    Route::post('orders/{order}/shipping-code', 'OrderController@updateShippingCode')->name('order.updateShippingCode');
    Route::post('orders/{order}/status', 'OrderController@changeStatus')->name('order.updateStatus');

    Route::post('orders/{order}/history', 'OrderHistoryController@store')->name('order.history.store');

    Route::get('invoices', 'InvoiceController@index')->name('invoices');
    Route::get('invoices/{invoice}', 'InvoiceController@show')->name('invoice.show');
    Route::post('invoices/{invoice}/cancel', 'InvoiceController@cancel')->name('invoice.cancel');
    Route::post('invoices/{invoice}/pay', 'InvoiceController@payManually')->name('invoice.pay');
});
