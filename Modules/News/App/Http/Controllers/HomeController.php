<?php

namespace Modules\News\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\News\App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // Featured posts: status published, latest 5
        $featuredPosts = Post::where('status', 'published')
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(5)
            ->get();

        // Latest posts: status published, skip 5, take 10
        $latestPosts = Post::where('status', 'published')
            ->with(['category', 'author'])
            ->latest('published_at')
            ->skip(5)
            ->take(10)
            ->get();

        return view('news::home', compact('featuredPosts', 'latestPosts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->firstOrFail();

        // Update view count logic can go here (e.g. Activity Log or simple increment)

        return view('news::show', compact('post'));
    }
    public function category($slug)
    {
        $category = \Modules\Category\App\Models\Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get posts in this category AND its children
        // NestedSet 'descendantsAndSelf' is useful here, but for simple belongsTo:
        // If strict relationship: $posts = $category->posts()->...
        // If including children:
        $categoryIds = $category->descendantsAndSelf($category->id)->pluck('id');
        
        $posts = Post::whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->with(['author'])
            ->latest('published_at')
            ->paginate(12);

        return view('news::category', compact('category', 'posts'));
    }
}
