<?php

namespace App\Http\Requests;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in([
                    Booking::STATUS_PENDING,
                    Booking::STATUS_CONFIRMED,
                    Booking::STATUS_IN_PROGRESS,
                    Booking::STATUS_COMPLETED,
                    Booking::STATUS_CANCELLED,
                ]),
            ],
            'mechanic_id' => [
                'nullable',
                Rule::exists('users', 'id')->where('role', User::ROLE_MECHANIC),
            ],
            'advisor_notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
