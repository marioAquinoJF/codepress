<?php

namespace CodePress\CodePost\Tests\Models;

use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodePost\Models\Post;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Validation\Validator;
use Mockery as m;

class PostTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_post_model()
    {
        $post = new Post();
        $validator = m::mock(Validator::class);
        $post->setValidator($validator);

        $this->assertEquals($post->getValidator(), $validator, 'Validator Injection.');
    }

    // unit test
    public function test_should_if_is_valid_when_it_is()
    {
        $post = new Post();
        $post->title = 'Post Test';
        $post->content = 'Content Post Test';

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')
                ->with([
                    'title' => 'required|max:255',
                    'content' => 'required'
        ]);
        $validator->shouldReceive('setData')
                ->with([
                    'title' => 'Post Test',
                    'content' => 'Content Post Test'
        ]);
        $validator->shouldReceive('fails')
                ->andReturn(false);

        $post->setValidator($validator);

        $this->assertTrue($post->isValid());
    }

    // unit test
    public function test_should_if_it_is_invalid_when_it_is()
    {

        $validator = m::mock(Validator::class);
        $messageBag = m::mock('Illuminate\Suport\MessageBag');
        $validator->shouldReceive('setRules')
                ->with([
                    'title' => 'required|max:255',
                    'content' => 'required'
        ]);
        $validator->shouldReceive('setData')
                ->with([
                    'title' => 'Post Test',
                    'content' => 'Content Post Test'
        ]);
        $validator->shouldReceive('fails')
                ->andReturn(true);
        $validator->shouldReceive('errors')
                ->andReturn($messageBag);

        $post = new Post();
        $post->title = 'Post Test';
        $post->content = 'Content Post Test';
        $post->setValidator($validator);

        $this->assertFalse($post->isValid());
        $this->assertEquals($messageBag, $post->errors);
    }

    public function test_check_if_a_post_can_be_persisted()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content Post']);
        $this->assertEquals('Post Test', $post->title);
        $this->assertEquals('Content Post', $post->content);

        $post = Post::all()->first();
        $this->assertEquals('Post Test', $post->title);
        $this->assertEquals('Content Post', $post->content);
    }

    public function test_can_validate_post()
    {

        $post = new Post();
        $post->title = 'Post Test';
        $post->content = 'Post Test';
        $factory = $this->app->make('Illuminate\Validation\Factory');
        $validator = $factory->make([
            'title' => 'required|max:255',
            'content' => 'required'], []);

        $post->setValidator($validator);
        $this->assertTrue($post->isValid());
        $post->title = '';
        $this->assertFalse($post->isValid());
    }

    /*  -> integration */

    public function test_check_if_post_is_slugable()
    {
        $post = Post::create(['title' => 'Post Test slaugable', 'content' => 'Content Post']);

        $this->assertEquals($post->slug, 'post-test-slaugable');
        $post = Post::create(['title' => 'Post Test slaugable', 'content' => 'Content Post']);
        $this->assertEquals($post->slug, 'post-test-slaugable-1');
        $post = Post::findBySlug('post-test-slaugable-1');
        $this->assertInstanceOf(Post::class, $post);
    }

    /* TAGS */

    public function test_if_create_tags_with_post()
    {
        $tag1 = Tag::create(['name' => 'Tag Test 1']);
        $tag2 = Tag::create(['name' => 'Tag Test 2']);

        $post = Post::create(['title' => 'Post Teste Tag', 'content' => 'Content 1']);
        $post->tags()->save($tag1);
        $post->tags()->save($tag2);

        $this->assertCount(2, $post->tags);
        $this->assertEquals('Tag Test 1', $post->tags[0]->name);
        $this->assertEquals('Tag Test 2', $post->tags[1]->name);

        $posts = Tag::find(1)->posts;
        $this->assertCount(1, $posts);
        $this->assertEquals('Post Teste Tag', $posts[0]->title);
    }

    public function test_if_create_categories_with_post()
    {
        $category1 = Category::create(['name' => 'Category Test 1']);
        $category2 = Category::create(['name' => 'Category Test 2']);

        $post = Post::create(['title' => 'Post Teste Category', 'content' => 'Content 1']);
        $post->categories()->save($category1);
        $post->categories()->save($category2);

        $this->assertCount(2, $post->categories);
        $this->assertEquals('Category Test 1', $post->categories[0]->name);
        $this->assertEquals('Category Test 2', $post->categories[1]->name);

        $posts = Category::find(1)->posts;
        $this->assertCount(1, $posts);
        $this->assertEquals('Post Teste Category', $posts[0]->title);
    }

    public function test_can_add_comments()
    {
    
        $post = Post::create(['title' => 'Post Teste Category', 'content' => 'Content 1']);
        $post->comments()->create(['content'=>'conteúdo 01']);
        $post->comments()->create(['content'=>'conteúdo 02']);

        $comments = Post::find(1)->comments;
        $this->assertCount(2, $comments);
        $this->assertEquals('conteúdo 01', $comments[0]->content);
        $this->assertEquals('conteúdo 02', $comments[1]->content);
    }

}
