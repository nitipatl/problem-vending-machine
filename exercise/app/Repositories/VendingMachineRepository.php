<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class VendingMachineRepository
{
    /**
     * @return array
     */
    public function getProducts()
    {
        $client = new Client();

        $response = $client->get(config('vending_machine.product_url'));

        return json_decode($response->getBody()->getContents(), true);
    }
}
