<?php

namespace Database\Seeders;

use App\Models\TagScheme;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagScheme::create([
            'name' => 'Red',
            'slug' => 'red',
            'class' => 'border-red-400 bg-red-100 text-red-400 transition hover:bg-red-400 hover:text-red-100'
        ]);

        TagScheme::create([
            'name' => 'Yellow',
            'slug' => 'yellow',
            'class' => 'border-yellow-400 bg-yellow-50 text-yellow-400 transition hover:bg-yellow-300 hover:text-yellow-100'
        ]);

        TagScheme::create([
            'name' => 'Green',
            'slug' => 'green',
            'class' => 'border-green-400 bg-green-100 text-green-400 transition hover:bg-green-400 hover:text-green-100'
        ]);

        TagScheme::create([
            'name' => 'Blue',
            'slug' => 'blue',
            'class' => 'border-blue-400 bg-blue-100 text-blue-600 transition hover:bg-blue-400 hover:text-blue-100'
        ]);

        TagScheme::create([
            'name' => 'Gray',
            'slug' => 'gray',
            'class' => 'border-gray-400 bg-gray-100 text-gray-400 transition hover:bg-gray-400 hover:text-gray-100'
        ]);
    }
}
