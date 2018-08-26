<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'VendingMachineController@showVendingMachinePage')->name('vending-machine');
Route::get('/get-products', 'VendingMachineController@getProductsList')->name('get-products');
