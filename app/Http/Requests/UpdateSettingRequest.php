<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            // General
            'company_name' => 'nullable|string|max:255',
            'company_tagline' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'established_year' => 'nullable|string|max:10',

            // Contact
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'whatsapp' => 'nullable|string|max:50',

            // Social
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',

            // Stats
            'years_in_business' => 'nullable|string|max:10',
            'projects_completed' => 'nullable|string|max:10',
            'design_awards' => 'nullable|string|max:10',

            // Hero
            'hero_title' => 'nullable|string|max:500',
            'hero_subtitle' => 'nullable|string|max:1000',

            // Branding (logo uploads)
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'logo_white' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'company_name.max' => 'Company name cannot exceed 255 characters.',
            'company_tagline.max' => 'Company tagline cannot exceed 255 characters.',
            'established_year.max' => 'Established year cannot exceed 10 characters.',
            'address.max' => 'Address cannot exceed 500 characters.',
            'phone.max' => 'Phone number cannot exceed 50 characters.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'whatsapp.max' => 'WhatsApp number cannot exceed 50 characters.',
            'instagram.max' => 'Instagram URL cannot exceed 255 characters.',
            'linkedin.max' => 'LinkedIn URL cannot exceed 255 characters.',
            'twitter.max' => 'Twitter URL cannot exceed 255 characters.',
            'years_in_business.max' => 'Years in business cannot exceed 10 characters.',
            'projects_completed.max' => 'Projects completed cannot exceed 10 characters.',
            'design_awards.max' => 'Design awards cannot exceed 10 characters.',
            'hero_title.max' => 'Hero title cannot exceed 500 characters.',
            'hero_subtitle.max' => 'Hero subtitle cannot exceed 1000 characters.',
            'logo.image' => 'Logo must be an image file.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg, svg, webp.',
            'logo.max' => 'Logo size cannot exceed 2MB.',
            'logo_white.image' => 'Logo (white) must be an image file.',
            'logo_white.mimes' => 'Logo (white) must be a file of type: jpeg, png, jpg, svg, webp.',
            'logo_white.max' => 'Logo (white) size cannot exceed 2MB.',
        ];
    }
}
