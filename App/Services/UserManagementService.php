<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserManagementService
{
    public function getAllUsers(): Collection
    {
        return User::latest()->get();
    }

    public function getMechanics(): Collection
    {
        return User::where('role', User::ROLE_MECHANIC)->get();
    }

    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function updateUserRole(User $targetUser, string $role): User
    {
        $targetUser->update(['role' => $role]);
        return $targetUser;
    }
}
