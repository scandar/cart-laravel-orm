<?php

Route::get('/', function () {
    return redirect()->route('cart.index');
});

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@create')->name('cart.create');
Route::get('cart/{id}', 'CartController@getCartById')->name('cart.getone');
Route::get('cart/{id}/items', 'CartController@getCartItems')->name('cart.getitems');
Route::post('cart/itemcart', 'CartController@addItemCart')->name('cart.additemcart');
Route::delete('cart/itemcart', 'CartController@destroyItemCart')->name('cart.destroyitemcart');
Route::post('cart/empty', 'CartController@emptyCart')->name('cart.empty');

Route::resource('items', 'ItemController');
