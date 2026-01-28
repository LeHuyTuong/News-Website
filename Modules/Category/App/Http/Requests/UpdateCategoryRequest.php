<?php

namespace Modules\Category\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $categoryId = $this->route('category');
        return [
            'name' => 'required|string|max:255',
            'slug' => ['nullable',
            'string',
            'max:255',
            Rule::unique('categories','slug')->ignore($categoryId)],
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' =>'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ];
    }
}