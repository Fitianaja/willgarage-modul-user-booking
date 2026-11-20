<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    public function getCustomerBookings(User $customer): Collection
    {
        return Booking::with(['vehicle', 'serviceAdvisor', 'mechanic'])
            ->where('customer_id', $customer->id)
            ->latest('booking_date')
            ->get();
    }

    public function getAllBookings(): Collection
    {
        return Booking::with(['customer', 'vehicle', 'serviceAdvisor', 'mechanic'])
            ->latest('booking_date')
            ->get();
    }

    public function createBooking(User $customer, array $data): Booking
    {
        return Booking::create([
            'customer_id' => $customer->id,
            'vehicle_id' => $data['vehicle_id'],
            'booking_date' => $data['booking_date'],
            'booking_time' => $data['booking_time'],
            'complaint' => $data['complaint'],
            'status' => Booking::STATUS_PENDING,
        ]);
    }

    public function cancelByCustomer(Booking $booking, User $customer): void
    {
        if ($booking->customer_id !== $customer->id) {
            abort(403, 'Anda tidak berhak membatalkan jadwal ini.');
        }

        if ($booking->status !== Booking::STATUS_PENDING) {
            throw new \RuntimeException('Hanya jadwal berstatus Pending yang dapat dibatalkan.');
        }

        $booking->update([
            'status' => Booking::STATUS_CANCELLED,
        ]);
    }

    public function verifyByAdvisor(Booking $booking, User $advisor, array $data): Booking
    {
        $booking->update([
            'service_advisor_id' => $advisor->id,
            'mechanic_id' => $data['mechanic_id'] ?? null,
            'status' => $data['status'],
            'advisor_notes' => $data['advisor_notes'] ?? null,
        ]);

        return $booking;
    }
}
