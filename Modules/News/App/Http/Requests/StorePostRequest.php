<?php

namespace Modules\News\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:posts,slug',
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
            'thumbnail.image'      => 'File upload phải là hình ảnh.',
            'thumbnail.max'        => 'Kích thước ảnh tối đa là 2MB.',
        ];
    }
}
