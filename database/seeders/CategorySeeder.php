<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'parent_id' => 0,
            'name' => 'General',
            'slug' => 'general',
        ]);
        Category::create([
            'parent_id' => 0,
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Category::create([
            'parent_id' => 0,
            'name' => 'Insight',
            'slug' => 'insight',
        ]);

        Category::create([
            'parent_id' => 0,
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);

        Category::create([
            'parent_id' => 0,
            'name' => 'Events',
            'slug' => 'events',
        ]);
    }
}
