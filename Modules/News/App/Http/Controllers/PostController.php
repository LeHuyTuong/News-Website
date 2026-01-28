<?php

namespace Modules\News\App\Http\Controllers;

use Modules\Core\App\Http\Controllers\BaseController;
use Modules\News\App\Models\Post;
use Inertia\Inertia;
use Modules\Category\App\Http\Requests\UpdateCategoryRequest;
use Modules\News\App\Http\Requests\StorePostRequest;
use Modules\News\App\Http\Requests\UpdatePostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'author'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        if (!auth()->user()->can('create posts')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }
        
        // 1. Lấy dữ liệu đã validate
        $data = $request->validated();

        // 2. Gán thông tin hệ thống
        $data['author_id'] = auth()->id();

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        }

        // 3. Xử lý upload ảnh
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }   

        $post = Post::create($data);

        return to_route('posts.index')->with('success', 'Tạo bài viết thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        if (!auth()->user()->can('edit posts')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }

        $post = Post::findOrFail($id);

        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        }

        // Xử lý ảnh mới và xóa ảnh cũ
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $post->update($data);

        return to_route('posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \Modules\Category\App\Models\Category::defaultOrder()->get()->toTree();
        return Inertia::render('Post/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = \Modules\Category\App\Models\Category::defaultOrder()->get()->toTree();

        return Inertia::render('Post/Edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('delete posts')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }

        $post = Post::findOrFail($id);
        
        // Chỉ xóa record, ảnh thumbnail giữ lại hoặc xóa tùy policy (ở đây chọn giữ lại vì dùng SoftDelete)
        $post->delete();

        return to_route('posts.index')->with('success', 'Xóa bài viết thành công');
    }
}
