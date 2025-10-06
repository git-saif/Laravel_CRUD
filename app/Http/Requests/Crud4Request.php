<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud4Request extends FormRequest
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



    /**
     * Main rules() method — auto select based on request type
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->storeRules();
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->updateRules();
        }

        return [];
    }

    /**
     * Validation for STORE (POST)
     */
    protected function storeRules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:crud4s,email',
            'phone' => 'required|string|max:20',
        ];
    }

    /**
     * Validation for UPDATE (PUT/PATCH)
     */
    protected function updateRules(): array
    {
        // Get current model instance or ID from route binding
        $crud4 = $this->route('crud_4') ?? $this->route('crud-4');
        $id = $crud4?->id ?? $crud4;

        return [
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('crud4s', 'email')->ignore($id),
            ],
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
