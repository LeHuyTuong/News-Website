<?php

namespace Modules\Sitemap\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\News\App\Models\Post;
use Modules\Category\App\Models\Category;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->latest('published_at')
            ->get();
            
        $categories = Category::where('is_active', true)->get();

        return response()->view('sitemap::index', [
            'posts' => $posts,
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sitemap::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('sitemap::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('sitemap::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
