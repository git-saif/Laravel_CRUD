<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud8Request extends FormRequest
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
            'crud7_id'   => 'required|exists:crud7s,id',
            'name'       => 'required|string|max:255|unique:crud8s,name',
            'serial_no'  => 'required|integer|unique:crud8s,serial_no',
            'status'     => 'required|in:active,inactive',
        ];
    }


    /**
     * Validation rules for updating data (PUT/PATCH).
     */
    protected function updateRules(): array
    {
        $crud8 = $this->route('crud8') ?? $this->route('crud_8') ?? $this->route('crud-8');
        $id = $crud8?->id ?? $crud8;

        return [
            'crud7_id'   => 'required|exists:crud7s,id',
            'name'       => ['required', 'string', 'max:255', Rule::unique('crud8s', 'name')->ignore($id)],
            'serial_no'  => ['required', 'integer', Rule::unique('crud8s', 'serial_no')->ignore($id)],
            'status'     => 'required|in:active,inactive',
        ];
    }


    /**
     *  Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'crud7_id.required'  => 'Please select a category.',
            'name.required'      => 'Subcategory name is required.',
            'name.unique'        => 'This subcategory already exists.',
            'serial_no.required' => 'Serial number is required.',
            'serial_no.unique'   => 'This serial number already exists.',
        ];
    }
}
