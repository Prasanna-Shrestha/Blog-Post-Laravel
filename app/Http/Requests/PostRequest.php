<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'body'  => 'required|string|min:100|max:1000',
            'action' => 'required|in:draft,submitted',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
            'new_categories' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title for your post.',
            'title.string' => 'The title must be valid text.',
            'title.min' => 'The title must be at least 5 characters long.',
            'title.max' => 'The title cannot exceed 255 characters.',

            'body.required' => 'Please write some content for your post.',
            'body.string' => 'The post content must be valid text.',
            'body.min' => 'The post content must be at least 100 characters long.',
            'body.max' => 'The post content cannot exceed 500 characters.',

            'action.required' => 'Please choose whether to save as a draft or submit for review.',
            'action.in' => 'The selected action is invalid.',

            'categories.array' => 'The selected categories are invalid.',
            'categories.*.integer' => 'Each category must be a valid category ID.',
            'categories.*.exists' => 'One or more selected categories do not exist.',

            'new_categories.string' => 'New categories must be entered as text.',
            'new_categories.max' => 'New categories cannot exceed 255 characters.',
        ];
    }
}
