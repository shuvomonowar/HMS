<?php

namespace App\Http\Requests\Admin\System;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Convert username to lowercase and remove spaces
        $this->merge([
            'username' => strtolower(str_replace(' ', '', $this->username))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rulesForStore(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:16',
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:16',
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
