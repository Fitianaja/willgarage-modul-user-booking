<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\VehicleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerBookingController extends Controller
{
    public function __construct(
        private readonly BookingService $bookingService,
        private readonly VehicleService $vehicleService
    ) {}

    public function index(Request $request): View
    {
        $bookings = $this->bookingService->getCustomerBookings($request->user());
        $vehicles = $this->vehicleService->getCustomerVehicles($request->user());

        return view('customer.bookings.index', compact('bookings', 'vehicles'));
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $this->bookingService->createBooking($request->user(), $request->validated());

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking jadwal servis berhasil dibuat.');
    }

    public function cancel(Request $request, Booking $booking): RedirectResponse
    {
        try {
            $this->bookingService->cancelByCustomer($booking, $request->user());
            return back()->with('success', 'Jadwal servis berhasil dibatalkan.');
        } catch (\RuntimeException $e) {
            return back()->withErrors(['status' => $e->getMessage()]);
        }
    }
}
