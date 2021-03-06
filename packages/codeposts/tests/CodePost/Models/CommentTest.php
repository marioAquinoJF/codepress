<?php

namespace CodePress\CodePost\Tests\Models;

use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodePost\Models\Comment;
use CodePress\CodePost\Models\Post;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Validation\Validator;
use Mockery as m;

class CommentTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_post_model()
    {
        $comment = new Comment();
        $validator = m::mock(Validator::class);
        $comment->setValidator($validator);

        $this->assertEquals($comment->getValidator(), $validator);
    }

    // unit test
    public function test_should_if_is_valid_when_it_is()
    {
        $comment = new Comment();
        $comment->content = 'Content Comment Test';

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')
                ->with([
                    'content' => 'required'
        ]);
        $validator->shouldReceive('setData')
                ->with([
                    'content' => 'Content Comment Test'
        ]);
        $validator->shouldReceive('fails')
                ->andReturn(false);

        $comment->setValidator($validator);

        $this->assertTrue($comment->isValid());
    }

    // unit test
    public function test_should_if_it_is_invalid_when_it_is()
    {
        $comment = new Comment();
        $comment->content = '';

        $validator = m::mock(Validator::class);
        $messageBag = m::mock('Illuminate\Suport\MessageBag');
        $validator->shouldReceive('setRules')
                ->with([
                    'content' => 'required'
        ]);
        $validator->shouldReceive('setData')
                ->with([
                    'content' => ''
        ]);
        $validator->shouldReceive('fails')
                ->andReturn(true);
        $validator->shouldReceive('errors')
                ->andReturn($messageBag);


        $comment->setValidator($validator);

        $this->assertFalse($comment->isValid());
        $this->assertEquals($messageBag, $comment->errors);
    }

    public function test_check_if_a_comment_can_be_persisted_through_a_post()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content Comment']);
        $comment = Comment::create(['content' => "Conteúdo do comentário", 'post_id' => $post->id]);

        $this->assertEquals("Conteúdo do comentário", $comment->content);

        $comment = Comment::all()->first();
        $this->assertEquals("Conteúdo do comentário", $comment->content);

        $post = Comment::find(1)->post;
        $this->assertEquals('Post Test', $post->title);
    }

    public function test_can_validate_comment()
    {
        $comment = new Comment();
        $comment->content = 'Comment Test';
        $factory = $this->app->make('Illuminate\Validation\Factory');
        $validator = $factory->make([], []);

        $comment->setValidator($validator);

        $this->assertTrue($comment->isValid());
        $comment->content = null;
        $this->assertFalse($comment->isValid());
    }

    public function test_can_force_delete_all_from_ralationship_post()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        Comment::create(['content' => "Conteúdo do comentário 1", 'post_id' => $post->id]);
        Comment::create(['content' => "Conteúdo do comentário 2", 'post_id' => $post->id]);
        $this->assertCount(2, $post->comments()->get());
        $post->comments()->forceDelete();
        $this->assertCount(0, $post->comments()->get());
    }

    public function test_can_restore_all_from_ralationship_post()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        Comment::create(['content' => "Conteúdo do comentário 1", 'post_id' => $post->id]);
        Comment::create(['content' => "Conteúdo do comentário 2", 'post_id' => $post->id]);
        $this->assertCount(2, $post->comments()->get());
        $post->comments()->delete();
        $this->assertCount(0, $post->comments()->get());
        $post->comments()->restore();
        $this->assertCount(2, $post->comments()->get());
    }

    public function test_can_find_the_model_deleted_from_ralationship()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        $comment = Comment::create(['content' => "Conteúdo do comentário 2", 'post_id' => $post->id]);
        $post->delete();
        $comment = Comment::find(1);
        $this->assertEquals('Post Test', $comment->post->title);
    }

    public function test_can_be_soft_deleted()
    {
        $post = Post::create(['title' => 'Post Teste Category', 'content' => 'Content 1']);
        $post->delete();
        $this->assertEquals(true, $post->trashed());
        $this->assertCount(0, Post::all());
    }

    public function test_can_get_rows_deleted()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        Post::create(['title' => 'Post Test 02', 'content' => 'Content 2']);
        $post->delete();
        $posts = Post::onlyTrashed()->get();
        $this->assertCount(1, $posts);
        $this->assertEquals(1, $posts[0]->id);
        $this->assertEquals("Post Test", $posts[0]->title);
    }

    public function test_can_get_rows_deleted_and_actives()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        Post::create(['title' => 'Post Test 02', 'content' => 'Content 2']);
        $post->delete();
        $posts = Post::withTrashed()->get();
        $this->assertCount(2, $posts);
        $this->assertEquals(1, $posts[0]->id);
        $this->assertEquals("Post Test", $posts[0]->title);
    }

    public function test_can_force_delete()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        $post->forceDelete();
        $posts = Post::withTrashed()->get();
        $this->assertCount(0, $posts);
    }

    public function test_can_restore_rows_deleted()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        $post->delete();
        $post->restore();
        $posts = Post::all();
        $this->assertEquals(1, $posts[0]->id);
        $this->assertEquals("Post Test", $posts[0]->title);
    }

}
