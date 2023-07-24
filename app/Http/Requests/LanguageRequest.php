<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',
            //  'active' => 'required|in:1',
            'direction' => 'required|in:rtl,ltr',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 100 characters.',
            'abbr.required' => 'The abbreviation field is required.',
            'abbr.string' => 'The abbreviation field must be a string.',
            'abbr.max' => 'The abbreviation field must not exceed 10 characters.',
            'direction.required' => 'The direction field is required.',
            'direction.in' => 'The direction field must be either "rtl" or "ltr".',
        ];
    }
}