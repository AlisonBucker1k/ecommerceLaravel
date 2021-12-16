<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

Route::prefix('/pagar-me')->group(function() {
    Route::post('/post-back', 'PagarMeController@postBack')->name('pagar_me.post_back');
});

Route::middleware('site.boot')->group(function() {
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('/home', 'IndexController@index');
    Route::get('/sobre', 'IndexController@about')->name('about');
    Route::get('/termos', 'IndexController@terms')->name('terms');
    Route::get('/canais-ajuda', 'IndexController@helpChannels')->name('help_channels');
    Route::get('/politicas/privacidade', 'IndexController@privacy')->name('privacy');
    Route::get('/politicas/entrega', 'IndexController@shipping')->name('shipping');
    Route::get('/politicas/troca', 'IndexController@exchange')->name('exchange');

    Route::get('/produtos/{category?}/{subcategory?}', 'ProductController@index')->name('products');
    Route::get('/produtos{product}/variations', 'ProductVariationController@variations')->name('product.variations');
    Route::get('/produtos/{product}/variations/find', 'ProductVariationController@find')->name('product.variations.find');
    Route::get('/produto/{product}/{productVariation?}', 'ProductController@show')->name('product.show');

    Route::get('/contato', 'ContactController@index')->name('contact');
    Route::post('/contato', 'ContactController@sendEmail')->name('contact');

    Route::get('/carrinho', 'CartController@index')->name('cart');
    Route::post('/carrinho/{product}/add', 'CartController@addProduct')->name('cart.product.add');
    Route::get('/carrinho/calculate-freight', 'CartController@calculateFreight')->name('cart.product.freight');

    Route::middleware(CheckLogin::class)->group(function() {
        Route::get('/carrinho/finalizar', 'CartController@confirmOrder')->name('cart.confirm');
        Route::post('/carrinho/finalizar', 'CartController@createOrder');
    });

    Route::get('/carrinho/{cartProduct}/remove', 'CartProductController@removeProduct')->name('cart.product.remove');
    Route::post('/carrinho/{cartProduct}/quantity', 'CartProductController@changeQuantity')->name('cart_product.change_quantity');

    Route::get('acessar', 'AuthController@index')->name('login');
    Route::post('acessar', 'AuthController@login');
    Route::get('sair', 'AuthController@logout')->name('customer.logout');

//    Route::get('cadastrar', 'CustomerController@create')->name('customer.register');
    Route::post('cadastrar', 'CustomerController@store')->name('customer.store');
    Route::get('clientes/{customer}', 'CustomerController@show')->name('customer.profile');

    Route::post('clientes/senha/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
    Route::get('clientes/senha/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');

    Route::post('clientes/senha/reset/', 'Auth\ResetPasswordController@reset')->name('customer.password.reset');
    Route::get('clientes/senha/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('customer.password.form');

    Route::get('endereco/buscar', 'AddressController@find')->name('address.find');

    Route::middleware(['Auth:web_site'])->prefix('painel')->name('panel.')->group(function() {
        Route::get('/', 'CustomerController@index')->name('panel');
        Route::get('perfil', 'CustomerController@profile')->name('profile');
        Route::post('perfil', 'CustomerController@update')->name('profile.edit');
        Route::get('perfil/desabilitar', 'CustomerController@delete')->name('profile.disable');
        Route::delete('perfil/desabilitar', 'CustomerController@destroy')->name('profile.disable');

        Route::get('enderecos', 'AddressController@show')->name('addresses');
        Route::post('enderecos', 'AddressController@store')->name('address.store');
        Route::post('enderecos/json', 'AddressController@storeAddressJson')->name('address.store.json');
        Route::get('enderecos/{address}/main', 'AddressController@setMain')->name('address.set_main');
        Route::get('enderecos/{address}/remover', 'AddressController@destroy')->name('address.delete');

        Route::get('pedidos', 'OrderController@orders')->name('orders');
        Route::get('pedidos/{order}', 'OrderController@show')->name('order.show');
        Route::get('pedidos/{order}/cancel','OrderController@destroy')->name('order.cancel');

        Route::get('fatura/{invoice}', 'InvoiceController@show')->name('invoice.show');
    });
});
