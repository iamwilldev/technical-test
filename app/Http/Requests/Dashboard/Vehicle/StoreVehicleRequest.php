<?php

namespace App\Http\Requests\Dashboard\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'type' => 'required|in:Goods,People',
            'registration_number' => 'required|string|unique:vehicles,registration_number,NULL,id,deleted_at,NULL',
            'fuel_consumption' => 'required|string',
            'service_schedule' => 'required|date',
            'last_kilometer' => 'required|string',
            'status' => 'required|in:Active,Service,Nonaktif',
        ];
    }
}
