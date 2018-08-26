<?php

namespace App\Http\Controllers;

use App\Repositories\MoneyRepository;
use App\Repositories\VendingMachineRepository;

class VendingMachineController extends Controller
{
    /**
     * @var VendingMachineRepository
     */
    protected $vending_machine_repository;

    /**
     * @var MoneyRepository
     */
    protected $money_repository;

    /**
     * VendingMachineController constructor.
     *
     * @param VendingMachineRepository $vending_machine_repository
     * @param MoneyRepository          $money_repository
     */
    public function __construct(VendingMachineRepository $vending_machine_repository, MoneyRepository $money_repository)
    {
        $this->vending_machine_repository = $vending_machine_repository;
        $this->money_repository = $money_repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVendingMachinePage()
    {
        $un_refund  = $this->money_repository->getUnRefund();

        return view('vending-machine', compact('un_refund'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsList()
    {
        $products = $this->vending_machine_repository->getProducts();

        return response()->json($products);
    }
}
