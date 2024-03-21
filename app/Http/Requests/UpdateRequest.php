<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'last_name'    => 'string|nullable',
            'first_name'   => 'string|nullable',
            'father_name'  => 'string|nullable',
            'company_name' => 'string|nullable',
            'phone'        => 'string|nullable',
            'email'        => 'email|nullable',
            'birth_date'   => 'date|nullable',
        ];
    }
}
