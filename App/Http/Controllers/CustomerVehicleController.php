<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Services\VehicleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerVehicleController extends Controller
{
    public function __construct(
        private readonly VehicleService $vehicleService
    ) {}

    public function index(Request $request): View
    {
        $vehicles = $this->vehicleService->getCustomerVehicles($request->user());

        return view('customer.vehicles.index', compact('vehicles'));
    }

    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $this->vehicleService->createVehicle($request->user(), $request->validated());

        return redirect()->route('customer.vehicles.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }
}
