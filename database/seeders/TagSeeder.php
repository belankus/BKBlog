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
            'class' => 'text-blue-800 bg-blue-100  border-blue-400  dark:hover:text-gray-300 dark:border-gray-700 hover:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700'
        ]);

        Tag::create([
            'name' => 'TailwindCss',
            'slug' => 'tailwind',
            'class' => 'text-gray-800 bg-gray-100 border-gray-500  dark:hover:text-gray-300 dark:border-gray-700 hover:text-gray-600 hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-700'
        ]);

        Tag::create([
            'name' => 'Bootstrap',
            'slug' => 'bootstrap',
            'class' => 'text-red-800 bg-red-100 border-red-400 dark:hover:text-gray-300 dark:border-gray-700 hover:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700'
        ]);

        Tag::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
            'class' => 'text-green-800 bg-green-100 border-green-400 dark:hover:text-gray-300 dark:border-gray-700 hover:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700'
        ]);

        Tag::create([
            'name' => 'Politics',
            'slug' => 'politics',
            'class' => 'text-yellow-800 bg-yellow-100 border-yellow-300 dark:hover:text-gray-300 dark:border-gray-700 hover:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700'
        ]);
    }
}
