<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Crud4Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:crud4s,email,' . $this->id,
            'phone' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Please enter a name.',
            'email.required' => 'Email address is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email already exists.',
            'phone.required' => 'Phone number is required.',
        ];
    }
}
