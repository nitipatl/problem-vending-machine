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

    /**
     * @return int
     */
    public function getUnRefund()
    {
        $money = Money::where('created_at', '>=', now()->subHour())->get();

        $insert = $money->where('status', config('vending_machine.money_statuses.insert'))->sum('value');
        $out = $money->whereIn('status', [
            config('vending_machine.money_statuses.change'),
            config('vending_machine.money_statuses.refund'),
            config('vending_machine.money_statuses.sell'),
        ])
            ->sum('value');

        return $insert - $out;
    }
}
