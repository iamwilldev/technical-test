<?php

namespace App\Http\Requests\Dashboard\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|uuid|exists:users,id',
            'vehicle_id' => 'required|uuid|exists:vehicles,id',
            'driver_id' => 'required|uuid|exists:drivers,id',
            'approvals' => 'required',
            'approval_status' => 'required|in:pending,approved,rejected',
        ];
    }
}
