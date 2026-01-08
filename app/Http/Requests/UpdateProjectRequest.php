<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'completion_date' => 'nullable|date',
            'area' => 'nullable|string|max:100',
            'scope' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'nullable',
            'is_published' => 'nullable',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
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
            'title.required' => 'Project title is required.',
            'title.max' => 'Project title cannot exceed 255 characters.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'location.required' => 'Project location is required.',
            'location.max' => 'Location cannot exceed 255 characters.',
            'completion_date.date' => 'Please provide a valid completion date.',
            'area.max' => 'Area cannot exceed 100 characters.',
            'scope.max' => 'Scope cannot exceed 255 characters.',
            'featured_image.image' => 'Featured image must be an image file.',
            'featured_image.mimes' => 'Featured image must be a file of type: jpeg, png, jpg, webp.',
            'featured_image.max' => 'Featured image size cannot exceed 5MB.',
            'images.*.image' => 'Gallery images must be image files.',
            'images.*.mimes' => 'Gallery images must be files of type: jpeg, png, jpg, webp.',
            'images.*.max' => 'Each gallery image size cannot exceed 5MB.',
        ];
    }
}
