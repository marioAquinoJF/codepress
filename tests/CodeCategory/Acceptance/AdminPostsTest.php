<?php

namespace CodePress\CodePost\Testing;

use CodePress\CodePost\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminPostsTest extends \TestCase
{

    use DatabaseTransactions;

    public function test_can_visit_admin_posts()
    {
        $this->visit('/admin/posts')
                ->see('Code Post');
    }

    public function test_verify_posts_listing()
    {
        Post::create(['title' => 'Post 01', 'content' => "Content Post 01"]);
        Post::create(['title' => 'Post 02', 'content' => "Content Post 02"]);
        Post::create(['title' => 'Post 03', 'content' => "Content Post 03"]);
        Post::create(['title' => 'Post 04', 'content' => "Content Post 04"]);

        $this->visit('/admin/posts')
                ->see('Post 01')
                ->see('Post 02')
                ->see('Post 03')
                ->see('Post 04');
    }

    public function test_click_create_new_post()
    {
        $this->visit('/admin/posts')
                ->click('New Post')
                ->seePageIs('/admin/posts/create')
                ->see('Create Post');
    }

    public function test_create_new_post()
    {
        $this->visit('/admin/posts/create')
                ->type('Post Test', 'title')
                ->press('Submit')
                ->seePageIs('admin/posts')
                ->see('Post Test');
    }

    public function test_click_edit_post()
    {
        $post = Post::create(['title' => 'Post 01', 'content' => "Content Post 01"]);
        $this->visit('/admin/posts')
                ->click("link_edit_post_{$post->id}")
                ->seePageIs("admin/posts/{$post->id}/edit")
                ->see('Edit Post');
    }

    public function test_edit_a_post()
    {

        $post = Post::create(['title' => 'Post 01', 'content' => "Content Post 01"]);
        $this->visit("/admin/posts/{$post->id}/edit")
                ->type('Post 01 Alterado', 'title')
                ->type("Content Post 01 Alterado", 'content')
                ->press('Submit')
                ->seePageIs("/admin/posts/{$post->id}/show")
                ->see('Post 01 Alterado')
                ->see('Content Post 01 Alterado');
    }

    public function test_list_deleted_posts()
    {

        $post = Post::create(['title' => 'Post 01 Deleted', 'content' => "Content Post 01"]);
        $post->delete();
        $post = Post::create(['title' => 'Post 03 Deleted', 'content' => "Content Post 03"]);
        $post->delete();
        $post = Post::create(['title' => 'Post 04 Deleted', 'content' => "Content Post 04"]);
        $post->delete();
        $post = Post::create(['title' => 'Post 05 Deleted', 'content' => "Content Post 05"]);
        $post->delete();
        $this->visit("/admin/posts/deleted")
                ->type('Post 01  Deleted', 'title')
                ->type("Content Post 01", 'content')
                ->type('Post 03  Deleted', 'title')
                ->type("Content Post 03", 'content')
                ->type('Post 04  Deleted', 'title')
                ->type("Content Post 04", 'content')
                ->type('Post 05  Deleted', 'title')
                ->type("Content Post 05", 'content');
    }

}
