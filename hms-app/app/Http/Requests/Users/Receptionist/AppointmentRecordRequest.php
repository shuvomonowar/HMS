<?php

namespace App\Http\Requests\Users\Receptionist;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRecordRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rulesForStore(): array
    {
        return [
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'appointment_day' => 'required|string',
            'appointment_time' => 'required',
            'appointment_date' => 'required|date',
            'reason' => 'required|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rulesForUpdate(): array
    {
        return [
            'patient_id' => 'required|integer',
            'patient_name' => 'required|string',
            'doctor_id' => 'required|integer',
            'doctor_name' => 'required|string',
            'appointment_day' => 'required|string',
            'appointment_time' => 'required',
            'appointment_date' => 'required|date',
            'appointment_serial' => 'required|integer',
            'reason' => 'required|string',
            'appointment_status' => 'required|string',
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
