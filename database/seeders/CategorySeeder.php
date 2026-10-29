<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            ['slug' => 'laravel', 'name' => 'Laravel'],
            ['slug' => 'php', 'name' => 'PHP'],
            ['slug' => 'bases-de-donnaes', 'name' => 'Bases de données'],
            ['slug' => 'front-end', 'name' => 'Développement front-end'],
        ] as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']],
            );
        }
    }
}
