<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveMoneyLogRequest;
use App\Repositories\MoneyRepository;
use App\Services\MoneyService;

class MoneyController extends Controller
{
    /**
     * @var MoneyService
     */
    protected $money_service;

    /**
     * @var MoneyRepository
     */
    protected $money_repository;

    /**
     * MoneyController constructor.
     *
     * @param MoneyService    $money_service
     * @param MoneyRepository $money_repository
     */
    public function __construct(MoneyService $money_service, MoneyRepository $money_repository)
    {
        $this->money_service = $money_service;
        $this->money_repository = $money_repository;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMoneyLogPage()
    {
        $money_logs = $this->money_repository->getMoneyLogs();
        list($sell, $sell_last_24hrs) = $this->money_repository->getMoneyReport();

        return view('money-log', compact('money_logs', 'sell', 'sell_last_24hrs'));
    }
}
