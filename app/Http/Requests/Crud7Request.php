<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud7Request extends FormRequest
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
     * Validation rules for storing data (POST).
     */
    protected function storeRules(): array
    {
        return [
            'name'       => 'required|string|max:255|unique:crud7s,name',
            'serial_no'  => 'required|integer|unique:crud7s,serial_no',
            'status'     => 'required|in:active,inactive',
        ];
    }

    /**
     * Validation rules for updating data (PUT/PATCH).
     */
    protected function updateRules(): array
    {
        $crud7 = $this->route('crud7') ?? $this->route('crud_7') ?? $this->route('crud-7');
        $id = $crud7?->id ?? $crud7;

        return [
            'name'       => ['required', 'string', 'max:255', Rule::unique('crud7s', 'name')->ignore($id)],
            'serial_no'  => ['required', 'integer', Rule::unique('crud7s', 'serial_no')->ignore($id)],
            'status'     => 'required|in:active,inactive',
        ];
    }


    /**
     *  Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'Category name is required.',
            'name.unique'        => 'This category name already exists.',
            'serial_no.required' => 'Serial number is required.',
            'serial_no.unique'   => 'This serial number already exists.',
            'status.required'    => 'Please select a status.',
        ];
    }
}
