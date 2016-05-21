<?php

namespace CodePress\CodeTag\Tests\Models;

use CodePress\CodeTag\Tests\AbstractTestCase;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodePost\Models\Post;
use Illuminate\Validation\Validator;
use Mockery as m;

class TagTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_check_if_a_tag_can_be_peristed()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $this->assertEquals('Tag Test', $tag->name);

        $tag = Tag::all()->first();
        $this->assertEquals('Tag Test', $tag->name);
    }

    // unit test
    public function test_should_if_is_valid_when_it_is()
    {

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')
                ->with(['name' => 'required|255']);
        $validator->shouldReceive('setData')
                ->with(['name' => 'Tag Test']);
        $validator->shouldReceive('fails')
                ->andReturn(false);

        $tag = new Tag();
        $tag->name = 'Tag Test';
        $tag->setValidator($validator);

        $this->assertTrue($tag->isValid());
    }

    // unit test
    public function test_should_if_it_is_invalid_when_it_is()
    {

        $validator = m::mock(Validator::class);
        $messageBag = m::mock('Illuminate\Suport\MessageBag');
        $validator->shouldReceive('setRules')
                ->with(['name' => 'required|255']);
        $validator->shouldReceive('setData')
                ->with(['name' => 'Tag Test']);
        $validator->shouldReceive('fails')
                ->andReturn(true);
        $validator->shouldReceive('errors')
                ->andReturn($messageBag);

        $tag = new Tag();
        $tag->name = 'Tag Test';
        $tag->setValidator($validator);

        $this->assertFalse($tag->isValid());
        $this->assertEquals($messageBag, $tag->errors);
    }

    public function test_check_if_a_tag_can_be_persisted()
    {
        $tag = Tag::create(['name' => 'Tag Test', 'active' => true]);
        $this->assertEquals('Tag Test', $tag->name);

        $tag = Tag::all()->first();
        $this->assertEquals('Tag Test', $tag->name);
    }

    public function test_check_if_a_tag_can_be_updated()
    {
        $tag = Tag::create(['name' => 'Tag Test', 'active' => true]);
        $tag = Tag::find(1);
        $tag->name = 'Tag Test Update';
        $tag->save();

        $tag = Tag::find(1);
        $this->assertEquals('Tag Test Update', $tag->name);
        $this->assertTrue($tag->active == false);
    }

    public function test_check_if_a_tag_can_be_searched()
    {
        $tag = Tag::create(['name' => 'Tag Test retrieved']);
        $tag = Tag::where(['name' => 'Tag Test retrieved'])->get();

        $this->assertEquals($tag[0] instanceof Tag, true);
        $this->assertEquals('Tag Test retrieved', $tag[0]->name);
    }

    //
     public function test_can_add_post_to_tag()
    {
        $tag = Tag::create(['name' => 'Tag Test']);

        $post1 = Post::create(['title' => 'post Teste 1', 'content' => 'Content 1']);
        $post1->tags()->save($tag);

        $post2 = Post::create(['title' => 'post Teste 2', 'content' => 'Content 2']);
        $post2->tags()->save($tag);

        $this->assertCount(1, Tag::all());
        $this->assertEquals('Tag Test', $post1->tags()->first()->name);
        $this->assertEquals('Tag Test', $post2->tags()->first()->name);

        $posts = Tag::find(1)->posts;
        // dd($posts);
        $this->assertCount(2, $posts);
        $this->assertEquals('post Teste 1', $posts[0]->title);
        $this->assertEquals('post Teste 2', $posts[1]->title);
    }

}
