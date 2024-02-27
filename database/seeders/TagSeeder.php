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
            'name' => 'Communal',
            'slug' => 'communal',
            'tag_scheme_id' => 1
        ]);

        Tag::create([
            'name' => 'TailwindCss',
            'slug' => 'tailwind',
            'tag_scheme_id' => 2
        ]);

        Tag::create([
            'name' => 'Bootstrap',
            'slug' => 'bootstrap',
            'tag_scheme_id' => 3
        ]);

        Tag::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
            'tag_scheme_id' => 4
        ]);

        Tag::create([
            'name' => 'Politics',
            'slug' => 'politics',
            'tag_scheme_id' => 5
        ]);
    }
}
