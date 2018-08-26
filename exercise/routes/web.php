<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'VendingMachineController@showVendingMachinePage')->name('vending-machine');
Route::get('/get-products', 'VendingMachineController@getProductsList')->name('get-products');

Route::get('/money-log', 'MoneyController@showMoneyLogPage')->name('money-log');
Route::post('/money-log', 'MoneyController@saveMoneyLog')->name('money-log');
