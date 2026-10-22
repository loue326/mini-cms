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
        foreach (['Laravel', 'PHP', 'Bases de données', 'Front-end'] as $name) {
            Category::firstOrCreate(
                ['slug' => str($name)->slug()],
                ['name' => $name],
            );
        }
    }
}
