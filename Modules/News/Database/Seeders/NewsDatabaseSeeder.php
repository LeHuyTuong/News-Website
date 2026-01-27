<?php

namespace Modules\News\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\News\App\Models\Post;
use Modules\Category\App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class NewsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $admin = User::first() ?? User::factory()->create(['name' => 'Admin']);

        for($i = 0 ; $i < 50; $i++){
            $title = fake()->sentence();
            Post::create([
                'category_id' => $categories->random()->id,
                'author_id' => $admin->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'content' => fake()->paragraphs(5, true),
                'status' => 'published',
                'published_at' => now(),
            ]);
        }
        $this->command->info('50 posts seeded!');
    }
}
