<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveMoneyLogRequest;
use App\Services\MoneyService;

class MoneyController extends Controller
{
    /**
     * @var MoneyService
     */
    protected $money_service;

    /**
     * MoneyController constructor.
     *
     * @param MoneyService $money_service
     */
    public function __construct(MoneyService $money_service)
    {
        $this->money_service = $money_service;
    }

    /**
     * @param SaveMoneyLogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveMoneyLog(SaveMoneyLogRequest $request)
    {
        $this->money_service->saveMoneyLog($request->input('values'), $request->input('status'));

        return response()->json(['message' => 'Save money log success.']);
    }
}
