<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'VendingMachineController@showVendingMachinePage')->name('vending-machine');
Route::get('/get-products', 'VendingMachineController@getProductsList')->name('get-products');

Route::post('/money-log', 'MoneyController@saveMoneyLog')->name('money-log');
