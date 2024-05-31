<?php

namespace App\Http\Requests\Users\Receptionist;

use Illuminate\Foundation\Http\FormRequest;

class PatientTestBlockRequest extends FormRequest
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
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
        ];
    }
}
