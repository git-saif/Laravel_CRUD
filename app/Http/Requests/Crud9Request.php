<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud9Request extends FormRequest
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
            'crud8_id'   => 'required|exists:crud8s,id',
            // optional: name unique per subcategory. If you want global unique, use unique:crud9s,name
            'name'       => [
                'required',
                'string',
                'max:255',
                Rule::unique('crud9s', 'name')->where(fn($q) => $q->where('crud8_id', $this->crud8_id))
            ],
            'serial_no'  => 'required|integer|unique:crud9s,serial_no',
            'status'     => 'required|in:active,inactive',
        ];
    }


    /**
     * Validation rules for updating data (PUT/PATCH).
     */
    protected function updateRules(): array
    {
        $crud9 = $this->route('crud9') ?? $this->route('crud_9') ?? $this->route('crud-9');
        $id = $crud9?->id ?? $crud9;

        return [
            'crud8_id'   => 'required|exists:crud8s,id',
            'name'       => [
                'required',
                'string',
                'max:255',
                Rule::unique('crud9s', 'name')->ignore($id)->where(fn($q) => $q->where('crud8_id', $this->crud8_id))
            ],
            'serial_no'  => ['required', 'integer', Rule::unique('crud9s', 'serial_no')->ignore($id)],
            'status'     => 'required|in:active,inactive',
        ];
    }



    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'crud8_id.required'  => 'Please select a subcategory.',
            'name.required'      => 'Name is required.',
            'name.unique'        => 'This name already exists under the selected subcategory.',
            'serial_no.required' => 'Serial number is required.',
            'serial_no.unique'   => 'This serial number already exists.',
        ];
    }
}
