<?php

namespace Modules\News\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('post'); // Lấy ID post từ URL admin/posts/{post}

        return [
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'slug'            => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($postId),
            ],
            'content'         => 'required|string',
            'status'          => 'required|in:draft,published,scheduled',
            'thumbnail'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at'    => 'required_if:status,scheduled|nullable|date',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'canonical_url'   => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Vui lòng chọn danh mục bài viết.',
            'title.required'       => 'Tiêu đề bài viết không được để trống.',
            'slug.unique'          => 'Đường dẫn (slug) đã tồn tại.',
            'published_at.required_if' => 'Vui lòng chọn thời gian đăng bài cho trạng thái hẹn giờ.',
        ];
    }
}
