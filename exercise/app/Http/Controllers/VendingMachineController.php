<?php

namespace App\Http\Controllers;

use App\Repositories\VendingMachineRepository;

class VendingMachineController extends Controller
{
    /**
     * @var VendingMachineRepository
     */
    protected $vending_machine_repository;

    /**
     * VendingMachineController constructor.
     *
     * @param VendingMachineRepository $vending_machine_repository
     */
    public function __construct(VendingMachineRepository $vending_machine_repository)
    {
        $this->vending_machine_repository = $vending_machine_repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVendingMachinePage()
    {
        $products = $this->vending_machine_repository->getProducts();

        return view('vending-machine', compact('products'));
    }
}
