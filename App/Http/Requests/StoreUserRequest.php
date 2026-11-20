<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'role' => [
                'required',
                Rule::in([
                    User::ROLE_ADMIN,
                    User::ROLE_SERVICE_ADVISOR,
                    User::ROLE_MECHANIC,
                    User::ROLE_CUSTOMER,
                ]),
            ],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
