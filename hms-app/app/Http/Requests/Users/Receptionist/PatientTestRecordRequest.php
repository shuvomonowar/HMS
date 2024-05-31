<?php

namespace App\Http\Requests\Users\Receptionist;

use Illuminate\Foundation\Http\FormRequest;

class PatientTestRecordRequest extends FormRequest
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
            'patient_test_id' => 'required|integer',
            'test_category_1' => 'required|string',
            'test_name_1' => 'required|string',
            'test_cost_1' => 'required|integer',
            'test_category_2' => 'nullable|string',
            'test_name_2' => 'nullable|string',
            'test_cost_2' => 'nullable|integer',
            'test_category_3' => 'nullable|string',
            'test_name_3' => 'nullable|string',
            'test_cost_3' => 'nullable|integer',
            'test_category_4' => 'nullable|string',
            'test_name_4' => 'nullable|string',
            'test_cost_4' => 'nullable|integer',
            'test_category_5' => 'nullable|string',
            'test_name_5' => 'nullable|string',
            'test_cost_5' => 'nullable|integer',
            'delivery_date' => 'required|date',
            'test_status' => 'required|string',
        ];
    }
}
