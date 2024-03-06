<?php

namespace App\Http\Requests\Dashboard\Booking;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'id' => 'required|uuid|unique:bookings,id,' . $this->booking->id . ',id,deleted_at,NULL',
            'user_id' => 'uuid|exists:users,id',
            'vehicle_id' => 'uuid|exists:vehicles,id',
            'driver_id' => 'uuid|exists:drivers,id',
            'approvals' => 'nullable',
            'approval_status' => 'nullable|in:pending,approved,rejected',
        ];
    }

    // error "SQLSTATE[42S22]: Column not found: 1054 Unknown column 'user_id' in 'where clause' (Connection: mysql, SQL: select count(*) as aggregate from `users` where `user_id` = 9b7dfcee-eca4-40e7-a2b2-26f388a7a5d9 and `9b7e1ebf-8327-4f08-8d46-e84803a32e0e` = id and `deleted_at` is null)"

}
