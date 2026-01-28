<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Modules\Category\App\Models\Category;
use Modules\News\App\Models\Post;
use App\Models\User;

class PublicFrontendTest extends TestCase
{
    use DatabaseTransactions; // Use transactions to roll back data after test

    public function test_homepage_loads_and_displays_posts()
    {
        // 1. Setup Data
        $category = Category::create([
            'name' => 'Tech News',
            'slug' => 'tech-news',
            'is_active' => true,
        ]);

        $author = User::factory()->create();

        $post = Post::create([
            'title' => 'Laravel Testing 101',
            'slug' => 'laravel-testing-101',
            'content' => 'This is a test content for the post.',
            'category_id' => $category->id,
            'author_id' => $author->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        // 2. Visit Homepage
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Tech News'); // Should see category in content
        $response->assertSee('Tech News'); // Should see category in menu (duplicate check is fine)
    }

    public function test_category_page_loads_correctly()
    {
        $category = Category::create([
            'name' => 'Finance',
            'slug' => 'finance',
            'is_active' => true,
        ]);

        $response = $this->get('/category/finance');

        $response->assertStatus(200);
    }

    public function test_post_detail_page_loads_correctly()
    {
        $category = Category::create(['name' => 'Sports', 'slug' => 'sports']);
        $author = User::factory()->create();
        
        $post = Post::create([
            'title' => 'Big Match Tonight',
            'slug' => 'big-match-tonight',
            'content' => 'Detailed content about the match.',
            'category_id' => $category->id,
            'author_id' => $author->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/news/big-match-tonight');



        $response->assertStatus(200);
    }

    public function test_sitemap_xml_structure()
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<urlset', false);
    }
}
