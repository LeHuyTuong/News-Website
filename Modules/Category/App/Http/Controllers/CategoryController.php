<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\App\Http\Requests\StoreCategoryRequest;
use Modules\Category\App\Http\Requests\UpdateCategoryRequest;
use Modules\Category\App\Models\Category;
use Modules\Core\App\Http\Controllers\BaseController;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Get tree data
        $categories = Category::defaultOrder()->get()->toTree();

        // 2. Return Inertia View instead of JSON
        return \Inertia\Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if (!auth()->user()->can('manage categories')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }

        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        $category = Category::create($data);

        return to_route('categories.index')->with('success', 'Tạo danh mục thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        if (!auth()->user()->can('manage categories')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }

        $category = Category::findOrFail($id);

        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        $category->update($data);

        return to_route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('manage categories')) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }

        $category = Category::findOrFail($id);

        // Tư duy ngân hàng: Kiểm tra xem có danh mục con không trước khi xóa
        if ($category->children()->count() > 0) {
           return redirect()->back()->withErrors(['error' => 'Không thể xóa danh mục có chứa danh mục con!']);
        }

        // Kiểm tra xem có bài viết không (Restrict logic)
        if ($category->posts()->count() > 0) {
             return redirect()->back()->withErrors(['error' => 'Không thể xóa danh mục đang có bài viết!']);
        }

        $category->delete();

        return to_route('categories.index')->with('success', 'Xóa danh mục thành công');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::defaultOrder()->get()->toTree();
        return \Inertia\Inertia::render('Category/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::defaultOrder()->get()->toTree(); // For parent selection
        
        return \Inertia\Inertia::render('Category/Edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $this->successResponse($category, 'Lấy chi tiết danh mục thành công');
    }
}
