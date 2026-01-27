<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function store(Request $request)
    {
        if (!auth()->user()->can('manage categories')) {
            abort(403, 'Bạn không có quyền tạo danh mục!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['name', 'parent_id', 'slug', 'meta_title', 'meta_description', 'is_active']);

        if (empty($data['slug'])) { 
        $data['slug'] = \Illuminate\Support\Str::slug($data['name']); 
        } 

        $categories = Category::create($data);

        return $this->successResponse($categories, 'Tạo danh mục thành công');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);
        return $this->successResponse($categories, 'Lấy chi tiết danh mục thành công');
    }
}
