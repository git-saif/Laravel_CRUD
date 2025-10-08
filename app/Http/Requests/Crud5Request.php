<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud5Request extends FormRequest
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
     * Determine which validation rules to apply based on request method.
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
     * Validation rules for storing data (POST).
     */
    protected function storeRules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:crud5s,email',
            'phone' => 'required|string|max:20|unique:crud5s,phone',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }


    /**
     * Validation rules for updating data (PUT/PATCH).
     */
    protected function updateRules(): array
    {
        $crud5 = $this->route('crud5') ?? $this->route('crud_5') ?? $this->route('crud-5');
        $id = $crud5?->id ?? $crud5;

        return [
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('crud5s', 'email')->ignore($id),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('crud5s', 'phone')->ignore($id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'Please enter a name.',
            'email.required' => 'Email is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email already exists.',
            'phone.required' => 'Phone number is required.',
            'phone.unique'   => 'This phone number already exists.',
            'image.required' => 'Please upload an image.',
            'image.image'    => 'File must be an image type.',
            'image.mimes'    => 'Image must be a jpeg, png, jpg, or gif format.',
            'image.max'      => 'Image size must not exceed 2MB.',
        ];
    }
}
