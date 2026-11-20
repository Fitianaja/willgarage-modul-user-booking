<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleService
{
    public function getCustomerVehicles(User $customer): Collection
    {
        return Vehicle::where('user_id', $customer->id)
            ->latest()
            ->get();
    }

    public function createVehicle(User $customer, array $data): Vehicle
    {
        return Vehicle::create([
            'user_id' => $customer->id,
            'plate_number' => strtoupper(trim($data['plate_number'])),
            'brand' => $data['brand'],
            'model' => $data['model'],
            'year' => $data['year'] ?? null,
        ]);
    }
}
