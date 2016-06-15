<?php

namespace CodePress\CodePost\Tests\Models;

use CodePress\CodeCategory\Tests\AbstractTestCase;
use CodePress\CodePost\Models\Post;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Validation\Validator;
use Mockery as m;

class PostInCategoryTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_if_create_posts_with_categories()
    {
        $category = Category::create(['name' => 'Category Test 1', 'active' => true]);
        $category->posts()->save(Post::create(['title' => 'Post Teste Category', 'content' => 'Content 1']));
        $category->posts()->save(Post::create(['title' => 'Post Teste Category2', 'content' => 'Content 2']));

        $this->assertCount(2, $category->posts);
        
    }

    public function test_if_delete_post_from_category()
    {
        $category = Category::create(['name' => 'Category Test 1', 'active' => true]);
        $category->posts()->save(Post::create(['title' => 'Post Teste Category', 'content' => 'Content 1']));
        $category->posts()->save(Post::create(['title' => 'Post Teste Category2', 'content' => 'Content 2']));

        $posts = Category::find($category->id)->posts;
        $posts[0]->delete();
        $posts = Category::find($category->id)->posts;
        $this->assertCount(1, $posts);
        $this->assertEquals('Post Teste Category2', $posts[0]->title);
    }
}

//c/xampp/htdocs/CodePress52/packages/codeposts