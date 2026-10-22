<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
        ]);

        $firstUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $additionalUsers = User::factory(2)->create();
        $users = collect([$firstUser])->concat($additionalUsers)->values();
        $categories = Category::all();
        $tags = Tag::all();

        foreach (range(0, 11) as $index) {
            $isPublished = $index < 9;

            $post = Post::factory()
                ->state([
                    'user_id' => $users[$index % $users->count()]->id,
                    'category_id' => $categories[$index % $categories->count()]->id,
                    'is_published' => $isPublished,
                    'published_at' => $isPublished ? now() : null,
                ])
                ->create();

            $post->tags()->attach(
                $tags->random(2)->modelKeys(),
            );
        }
    }
}
