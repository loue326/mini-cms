<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

it('lists posts with their category, author and tags without lazy loading', function () {
    $category = Category::factory()->create(['name' => 'Tutoriels']);
    $tag = Tag::factory()->create(['name' => 'Astuce']);
    $author = User::factory()->create(['name' => 'Amira Ben Salah']);

    $posts = Post::factory(3)->published()->create([
        'category_id' => $category->id,
        'user_id' => $author->id,
    ]);

    $posts->each(fn (Post $post) => $post->tags()->attach($tag));

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('Tutoriels')
        ->assertSee('Amira Ben Salah')
        ->assertSee('Astuce');
});

it('keeps the posts when their category is deleted', function () {
    $category = Category::factory()->create();
    $post = Post::factory()->create(['category_id' => $category->id]);

    $category->delete();

    $this->assertDatabaseHas('posts', ['id' => $post->id]);
    expect($post->fresh()->category_id)->toBeNull();
});

it('replaces the tags of a post with sync', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->tags()->attach([$tags[0]->id, $tags[1]->id]);
    $post->tags()->sync([$tags[1]->id, $tags[2]->id]);

    expect($post->tags()->count())->toBe(2);
    $this->assertDatabaseMissing('post_tag', [
        'post_id' => $post->id,
        'tag_id' => $tags[0]->id,
    ]);
    $this->assertDatabaseHas('post_tag', [
        'post_id' => $post->id,
        'tag_id' => $tags[2]->id,
    ]);
});

it('removes the pivot rows when a post is deleted', function () {
    $post = Post::factory()->create();
    $tag = Tag::factory()->create();
    $post->tags()->attach($tag);

    $this->delete(route('posts.destroy', $post));

    $this->assertDatabaseMissing('post_tag', ['post_id' => $post->id]);
    $this->assertDatabaseHas('tags', ['id' => $tag->id]);
});

it('shows up to three other published posts from the same category', function () {
    $category = Category::factory()->create();

    $current = Post::factory()->published()->create([
        'title' => 'Article actuel',
        'category_id' => $category->id,
    ]);

    $oldest = Post::factory()->published()->create([
        'title' => 'Article ancien',
        'category_id' => $category->id,
        'published_at' => now()->subDays(4),
    ]);

    $middle = Post::factory()->published()->create([
        'title' => 'Article moyen',
        'category_id' => $category->id,
        'published_at' => now()->subDays(3),
    ]);

    $recent = Post::factory()->published()->create([
        'title' => 'Article recent',
        'category_id' => $category->id,
        'published_at' => now()->subDay(),
    ]);

    $newest = Post::factory()->published()->create([
        'title' => 'Article le plus recent',
        'category_id' => $category->id,
        'published_at' => now(),
    ]);

    Post::factory()->create([
        'title' => 'Brouillon a exclure',
        'category_id' => $category->id,
        'published_at' => null,
    ]);

    $response = $this->get(route('posts.show', $current));

    $response->assertOk()
        ->assertSee('Dans la même catégorie')
        ->assertSee('Article le plus recent')
        ->assertSee('Article recent')
        ->assertSee('Article moyen')
        ->assertDontSee('Brouillon a exclure');

    $html = $response->getContent();
    $sectionStart = strpos($html, 'Dans la même catégorie');
    $section = substr($html, $sectionStart);

    expect($section)
        ->not->toContain('Article actuel')
        ->not->toContain('Article ancien');

    expect($section)
        ->toContain('Article le plus recent')
        ->toContain('Article recent')
        ->toContain('Article moyen');
});

it('does not show related posts when the article has no category', function () {
    $post = Post::factory()->published()->create([
        'category_id' => null,
    ]);

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertDontSee('Dans la même catégorie');
});
