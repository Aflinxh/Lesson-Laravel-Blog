<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
    {
        return auth() ->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:5024',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'category_id.required' => 'Category is required',
            'image.image' => 'Image must be an image file',
            'image.file' => 'Image must be a file',
            'image.max' => 'Image size must not exceed 5MB',
            'body.required' => 'Body is required',
        ];
    }
}
