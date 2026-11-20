<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyBookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\UserManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StaffBookingController extends Controller
{
    public function __construct(
        private readonly BookingService $bookingService,
        private readonly UserManagementService $userService
    ) {}

    public function index(): View
    {
        $bookings = $this->bookingService->getAllBookings();
        $mechanics = $this->userService->getMechanics();

        return view('staff.bookings.index', compact('bookings', 'mechanics'));
    }

    public function update(VerifyBookingRequest $request, Booking $booking): RedirectResponse
    {
        $this->bookingService->verifyByAdvisor($booking, $request->user(), $request->validated());

        return redirect()->route('staff.bookings.index')
            ->with('success', 'Jadwal servis berhasil diperbarui.');
    }
}
