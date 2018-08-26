<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Product URL
    |--------------------------------------------------------------------------
    |
    | This value is the url to call products list for show in vending machine page.
    |
    */

    'product_url' => env('PRODUCT_URL', 'http://www.mocky.io/v2/5af11f8c3100004d0096c7ed'),

    /*
    |--------------------------------------------------------------------------
    | Available coin
    |--------------------------------------------------------------------------
    |
    | This value is the coins that can use in vending machine.
    |
    */

    'available_coins' => env('AVAILABLE_COINS', [1, 2, 5, 10]),

    /*
    |--------------------------------------------------------------------------
    | Money status
    |--------------------------------------------------------------------------
    |
    | This value is the statuses of money that store in database.
    |
    */

    'money_statuses' => [
        'insert' => 1,
        'change' => 2,
        'refund' => 3,
        'sell' => 10,
    ],
];
