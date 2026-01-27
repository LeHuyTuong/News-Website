<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Category\App\Models\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $news = Category::create([
            'name' => 'Thời sự',
            'slug' => 'thoi-su',
            'is_active' => true
        ]);

        $news->children()->createMany([
            ['name' => 'Thế giới', 'slug' => 'the-gioi', 'is_active' => true],
            ['name' => 'Kinh tế', 'slug' => 'kinh-te', 'is_active' => true],
            ['name' => 'Xã hội', 'slug' => 'xa-hoi', 'is_active' => true],
        ]);

        $tech = Category::create([
            'name' => 'Công nghệ',
            'slug' => 'cong-nghe',
            'is_active' => true
        ]);

        $tech->children()->createMany([
            ['name' => 'Khoa học', 'slug' => 'khoa-hoc', 'is_active' => true],
            ['name' => 'Internet', 'slug' => 'internet', 'is_active' => true],
            ['name' => 'AI', 'slug' => 'ai', 'is_active' => true],
        ]);

        $this->command->info('Category table seeded!');
    }
}
