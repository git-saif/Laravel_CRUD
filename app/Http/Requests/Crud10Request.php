<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Crud10Request extends FormRequest
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

    protected function storeRules(): array
    {
        return [
            'crud7_id' => 'required|exists:crud7s,id',
            'crud8_id' => 'nullable|exists:crud8s,id',
            'crud9_id' => 'nullable|exists:crud9s,id',
            'post_serial' => 'required|integer|unique:crud10s,post_serial',
            'post_name'   => 'required|string|max:255|unique:crud10s,post_name',
            'post_title'  => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'post'        => 'required|string',
            'status'      => 'required|in:active,inactive',
        ];
    }

    protected function updateRules(): array
    {
        $crud10 = $this->route('crud10') ?? $this->route('crud_10') ?? $this->route('crud-10');
        $id = $crud10?->id ?? $crud10;

        return [
            'crud7_id'    => 'required|exists:crud7s,id',
            'crud8_id'    => 'nullable|exists:crud8s,id',
            'crud9_id'    => 'nullable|exists:crud9s,id',
            'post_serial' => ['required', 'integer', Rule::unique('crud10s', 'post_serial')->ignore($id)],
            'post_name'   => ['required', 'string', 'max:255', Rule::unique('crud10s', 'post_name')->ignore($id)],
            'post_title'  => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'post'        => 'required|string',
            'status'      => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'crud7_id.required' => 'Please select a category.',
            'post_name.required' => 'Post name is required.',
            'post_serial.unique' => 'This serial number already exists.',
        ];
    }
}
