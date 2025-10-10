<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud6Request extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->storeRules();
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->updateRules();
        }

        return [];
    }

    /**
     * Validation rules for storing data.
     */
    protected function storeRules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:crud6s,email',
            'phone'  => 'required|string|max:20|unique:crud6s,phone',
            'image'  => 'required|array|min:1',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Validation rules for updating data.
     */
    protected function updateRules(): array
    {
        $crud6 = $this->route('crud6') ?? $this->route('crud_6') ?? $this->route('crud-6');
        $id = $crud6?->id ?? $crud6;

        return [
            'name'   => 'required|string|max:255',
            'email'  => ['required', 'email', Rule::unique('crud6s', 'email')->ignore($id)],
            'phone'  => ['required', 'string', 'max:20', Rule::unique('crud6s', 'phone')->ignore($id)],
            'existing_images' => 'sometimes|array',
            'existing_images.*' => 'sometimes|string',
            'delete_images' => 'sometimes|array',
            'delete_images.*' => 'sometimes|string',
            'replace_images' => 'sometimes|array',
            'replace_images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_images' => 'sometimes|array',
            'new_images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a name.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email already exists.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number already exists.',
            'image.required' => 'Please upload at least one image.',
            'image.*.image' => 'Each file must be an image.',
            'image.*.mimes' => 'Allowed image formats: jpeg, png, jpg, gif.',
            'image.*.max' => 'Image must not exceed 2MB.',
        ];
    }
}
