<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $data = [
            'user' => $user,
            'totalBookings' => Booking::count(),
            'pendingBookings' => Booking::where('status', Booking::STATUS_PENDING)->count(),
            'myVehiclesCount' => $user->hasRole(User::ROLE_CUSTOMER) ? Vehicle::where('user_id', $user->id)->count() : 0,
            'myBookingsCount' => $user->hasRole(User::ROLE_CUSTOMER) ? Booking::where('customer_id', $user->id)->count() : 0,
        ];

        return view('dashboard.index', $data);
    }
}
