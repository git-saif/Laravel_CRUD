<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name'           => 'required|string|max:255',
            'company_tagline'        => 'required|string|max:255',
            'company_email'          => 'required|email|max:255|unique:companies,company_email',
            'company_phone'          => 'required|string|max:255|unique:companies,company_phone',
            'company_address'        => 'required|string|max:255',
            'company_favicon'        => 'required|image|mimes:ico,png,jpg,jpeg|max:2048',
            'company_logo'           => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'company_booking_link'   => 'required|string|max:255',
            'company_whatsapp_link'  => 'required|string|max:255',
            'company_facebook_link'  => 'required|string|max:255',
            'company_instagram_link' => 'required|string|max:255',
            'company_twitter_link'   => 'required|string|max:255',
            'company_youtube_link'   => 'required|string|max:255',
            'company_linkedin_link'  => 'required|string|max:255',
            'company_google_map_link' => 'required|string|max:255',
            'status'                 => 'required|in:active,inactive',
        ];
    }

    protected function updateRules(): array
    {
        $setting = $this->route('company'); // resource route parameter
        $id = $setting?->id ?? $setting;

        return [
            'company_name'           => 'required|string|max:255',
            'company_tagline'        => 'required|string|max:255',
            'company_email'          => [
                'required',
                'email',
                'max:255',
                Rule::unique('companies', 'company_email')->ignore($id),
            ],
            'company_phone'          => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'company_phone')->ignore($id),
            ],
            'company_address'        => 'required|string|max:255',
            'company_favicon'        => 'nullable|image|mimes:ico,png,jpg,jpeg|max:2048',
            'company_logo'           => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'company_booking_link'   => 'required|string|max:255',
            'company_whatsapp_link'  => 'required|string|max:255',
            'company_facebook_link'  => 'required|string|max:255',
            'company_instagram_link' => 'required|string|max:255',
            'company_twitter_link'   => 'required|string|max:255',
            'company_youtube_link'   => 'required|string|max:255',
            'company_linkedin_link'  => 'required|string|max:255',
            'company_google_map_link' => 'required|string|max:255',
            'status'                 => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'email.email' => 'Please enter a valid email address.',
            'company_email.unique' => 'This email already exists.',
            'company_phone.unique' => 'This phone number already exists.',
            'company_favicon.image' => 'Favicon must be an image file.',
            'company_logo.image' => 'Logo must be an image file.',
        ];
    }
}
