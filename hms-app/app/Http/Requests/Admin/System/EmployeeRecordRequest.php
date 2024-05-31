<?php

namespace App\Http\Requests\Admin\System;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true if authorization is not required
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
     * Get the validation rules that apply to the store request.
     *
     * @return array
     */
    public function rulesForStore(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
            'designation' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nid' => 'required|numeric|digits:10',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
            'designation' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nid' => 'required|numeric|digits:10',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
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
