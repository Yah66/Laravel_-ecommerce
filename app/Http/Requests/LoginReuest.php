<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginReuest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
            // min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            // 'password.min' => 'The password must be at least 8 characters long.',
            // 'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.',
        ];
    }
}