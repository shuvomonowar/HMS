<?php

namespace App\Http\Requests\Users\Receptionist;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            // 'email' => ['required', 'email'],
            'username' => ['required', Rule::exists('employee_records', 'username')],
            'password' => ['required', 'min:8', 'max:16']
        ];
    }
}
