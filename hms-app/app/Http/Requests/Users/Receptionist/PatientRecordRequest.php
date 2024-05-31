<?php

namespace App\Http\Requests\Users\Receptionist;

use Illuminate\Foundation\Http\FormRequest;

class PatientRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the store request.
     *
     * @return array
     */
    public function rulesForStore(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'blood_group' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'email|max:255',
            'appointment_day' => 'required|string',
            'appointment_time' => 'required|date_format:h:i A',
            'appointment_date' => 'required|date',
            'reason' => 'required|string',
            'doctor_id' => 'required|integer',
        ];
    }

    /**
     * Get the validation rules that apply to the update request.
     *
     * @return array
     */
    public function rulesForUpdate(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'blood_group' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'email|max:255',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => $this->rulesForStore(),
            'PUT', 'PATCH' => $this->rulesForUpdate(),
            default => [],
        };
    }
}
