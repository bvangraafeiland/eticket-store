<?php

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

Auth::routes();

Route::get('/', function () {
    return redirect('/tickets');
});

Route::get('tickets/download/{purchase}/{code}', 'TicketsController@download')->name('tickets.download');
Route::resource('tickets', 'TicketsController');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::get('cart/add/{ticket}', 'CartController@create')->name('cart.add');
Route::post('cart/add/{ticket}', 'CartController@store')->name('cart.add');
Route::delete('cart/{ticket}', 'CartController@destroy')->name('cart.destroy');

Route::get('purchases', 'PurchasesController@index')->name('purchases.index');
Route::post('purchases', 'PurchasesController@store')->name('purchases.store');
Route::get('purchases/{purchase}', 'PurchasesController@show')->name('purchases.show');
