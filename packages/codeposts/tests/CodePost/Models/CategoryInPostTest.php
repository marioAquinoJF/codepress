<?php

namespace CodePress\CodePost\Tests\Models;

use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodePost\Models\Post;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Validation\Validator;
use Mockery as m;

class CategoryInPostTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_if_create_categories_with_post()
    {
        $category1 = Category::create(['name' => 'Category Test 1', 'active' => true]);
        $category2 = Category::create(['name' => 'Category Test 2', 'active' => true]);

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

    public function test_can_force_delete_all_from_ralationship_post()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        $post->categories()->save(Category::create(['name' => 'Category Test 1', 'active' => true]));
        $post->categories()->save(Category::create(['name' => 'Category Test 2', 'active' => true]));

        $post2 = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
        $post2->categories()->save(Category::create(['name' => 'Category Test 3', 'active' => true]));
        $post2->categories()->save(Category::create(['name' => 'Category Test 4', 'active' => true]));

        $categories = Post::find($post->id)->categories;

        $this->assertCount(2, $categories);
        $categories[0]->delete();
        $categories[1]->delete();
        
        $categories = Post::find($post->id)->categories;
        $this->assertCount(0, $categories);
    }

    /*
      public function test_can_restore_all_from_ralationship_post()
      {
      $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
      Category::create(['name' => 'Category Test 1', 'active' => true]);
      Category::create(['name' => 'Category Test 2', 'active' => true]);
      $this->assertCount(2, $post->categories()->get());
      $post->categories()->delete();
      //  $this->assertCount(0, $post->categories()->onlyTrashed()->get());
      $post->categories()->restore();
      $this->assertCount(2, $post->categories()->get());
      }

      public function test_can_find_the_model_deleted_from_ralationship()
      {
      $post = Post::create(['title' => 'Post Test', 'content' => 'Content 1']);
      $category = Category::create(['name' => 'Category Test 2', 'active' => true]);
      $post->delete();
      $category = Category::find(1);
      $this->assertEquals('Post Test', $category->post->title);
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
     */
}

//c/xampp/htdocs/CodePress52/packages/codeposts