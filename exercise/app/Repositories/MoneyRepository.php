<?php

namespace App\Repositories;

use App\Money;

class MoneyRepository
{
    /**
     * @return mixed
     */
    public function getMoneyLogs()
    {
        return Money::orderByDesc('created_at')->paginate();
    }

    /**
     * @return array
     */
    public function getMoneyReport()
    {
        $sell = Money::where('status', config('vending_machine.money_statuses.sell'))
            ->sum('value');

        $sell_last_24hrs = Money::where('status', config('vending_machine.money_statuses.sell'))
            ->where('created_at', '>=', now()->subDay())
            ->sum('value');

        return [$sell, $sell_last_24hrs];
    }
}
