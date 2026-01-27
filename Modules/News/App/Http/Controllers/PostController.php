<?php

namespace Modules\News\App\Http\Controllers;

use Modules\Core\App\Http\Controllers\BaseController;
use Modules\News\App\Models\Post;
use Inertia\Inertia;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::with(['category', 'author'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }
}
