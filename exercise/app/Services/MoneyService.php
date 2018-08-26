<?php

namespace App\Services;

use App\Money;
use Illuminate\Support\Facades\DB;

class MoneyService
{
    /**
     * @param int $values
     * @param int $status
     */
    public function saveMoneyLog(array $values, int $status)
    {
        DB::transaction(function () use ($values, $status) {
            foreach ($values as $value) {
                Money::create([
                    'value' => $value,
                    'status' => $status,
                ]);
            }
        });
    }
}
