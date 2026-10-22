<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Débutant', 'Astuce', 'Sécurité', 'Performance', 'Tests', 'Blade'] as $name) {
            Tag::firstOrCreate(
                ['slug' => str($name)->slug()],
                ['name' => $name],
            );
        }
    }
}
