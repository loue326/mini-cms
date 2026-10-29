<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

it('seeds the French demo dataset with the required counts and relations', function () {
    $this->seed(DatabaseSeeder::class);

    expect(User::count())->toBe(3)
        ->and(Category::count())->toBe(4)
        ->and(Tag::count())->toBe(6)
        ->and(Post::count())->toBe(12)
        ->and(Post::where('is_published', true)->count())->toBe(9)
        ->and(Post::where('is_published', false)->count())->toBe(3)
        ->and(DB::table('post_tag')->count())->toBe(24)
        ->and(Post::whereNull('user_id')->count())->toBe(0)
        ->and(Post::whereNull('category_id')->count())->toBe(0);

    $this->assertDatabaseHas('posts', [
        'title' => 'Introduction à Laravel',
        'slug' => 'introduction-a-laravel',
        'is_published' => true,
    ]);

    $this->assertDatabaseHas('categories', [
        'slug' => 'bases-de-donnaes',
        'name' => 'Bases de données',
    ]);

    $this->assertDatabaseHas('tags', [
        'slug' => 'sacurita',
        'name' => 'Sécurité',
    ]);
});
