<?php

use App\Models\Post;
use App\Models\Tag;

beforeEach(function () {
    $this->withoutVite();
});

function postData(array $overrides = []): array
{
    return array_merge([
        'title' => 'Article de test',
        'slug' => 'article-de-test',
        'excerpt' => 'Un extrait court.',
        'body' => 'Contenu assez long pour passer la validation.',
        'is_published' => '0',
    ], $overrides);
}

it('creates a post from the form', function () {
    $this->post(route('posts.store'), postData())
        ->assertRedirect();

    $this->assertDatabaseHas('posts', [
        'title' => 'Article de test',
        'slug' => 'article-de-test',
        'excerpt' => 'Un extrait court.',
    ]);
});

it('syncs the submitted tags when creating a post', function () {
    $tags = Tag::factory(2)->create();

    $this->post(route('posts.store'), postData(['tags' => [$tags[0]->id]]))
        ->assertRedirect();

    $post = Post::query()->where('slug', 'article-de-test')->firstOrFail();

    expect($post->tags()->pluck('tags.id')->all())->toBe([$tags[0]->id]);
});

it('does not create a post without a title', function () {
    $this->post(route('posts.store'), postData(['title' => '']))
        ->assertRedirect();

    $this->assertDatabaseMissing('posts', ['slug' => 'article-de-test']);
});

it('shows the edit form with the current values', function () {
    $post = Post::create(postData(['title' => 'Titre initial']));

    $this->get(route('posts.edit', $post))
        ->assertOk()
        ->assertSee('Titre initial');
});

it('updates a post and keeps its own slug', function () {
    $post = Post::create(postData());

    $this->put(route('posts.update', $post), postData(['title' => 'Titre modifie']))
        ->assertRedirect(route('posts.show', $post));

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Titre modifie',
        'slug' => 'article-de-test',
    ]);
});

it('replaces its tags when updating and removes them when none are submitted', function () {
    $post = Post::create(postData());
    $tags = Tag::factory(3)->create();
    $post->tags()->sync([$tags[0]->id, $tags[1]->id]);

    $this->put(route('posts.update', $post), postData([
        'tags' => [$tags[1]->id, $tags[2]->id],
    ]))->assertRedirect(route('posts.show', $post));

    expect($post->fresh()->tags()->pluck('tags.id')->all())->toBe([$tags[1]->id, $tags[2]->id]);

    $this->put(route('posts.update', $post), postData())
        ->assertRedirect(route('posts.show', $post));

    expect($post->fresh()->tags()->count())->toBe(0);
});

it('refuses the slug of another post', function () {
    Post::create(postData(['slug' => 'slug-deja-pris']));
    $post = Post::create(postData());

    $this->put(route('posts.update', $post), postData(['slug' => 'slug-deja-pris']))
        ->assertRedirect();

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'slug' => 'article-de-test',
    ]);
});

it('deletes a post', function () {
    $post = Post::create(postData());

    $this->delete(route('posts.destroy', $post))
        ->assertRedirect(route('posts.index'));

    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});
it('publishes a draft', function () {
    $post = Post::create(postData([
        'is_published' => false,
        'published_at' => null,
    ]));

    $this->patch(route('posts.publication', $post))
        ->assertRedirect(route('posts.show', $post));

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'is_published' => 1,
    ]);

    $this->assertNotNull($post->fresh()->published_at);
});
