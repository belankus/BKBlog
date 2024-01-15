<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        Tag::create([
            'name' => 'TailwindCss',
            'slug' => 'tailwind',
        ]);

        Tag::create([
            'name' => 'Bootstrap',
            'slug' => 'bootstrap',
        ]);

        Tag::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
        ]);

        Tag::create([
            'name' => 'Politics',
            'slug' => 'politics',
        ]);
    }
}
