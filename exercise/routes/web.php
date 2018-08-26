<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'VendingMachineController@showVendingMachinePage')->name('vending-machine');
