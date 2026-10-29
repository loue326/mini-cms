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
        foreach ([
            ['slug' => 'dabutant', 'name' => 'Débutant'],
            ['slug' => 'astuce', 'name' => 'Astuce'],
            ['slug' => 'sacurita', 'name' => 'Sécurité'],
            ['slug' => 'performance', 'name' => 'Performance'],
            ['slug' => 'tests', 'name' => 'Tests automatisés'],
            ['slug' => 'blade', 'name' => 'Composants Blade'],
        ] as $tag) {
            Tag::updateOrCreate(
                ['slug' => $tag['slug']],
                ['name' => $tag['name']],
            );
        }
    }
}
