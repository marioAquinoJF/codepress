<?php

namespace CodePress\CodeTag\Testing;

use CodePress\CodeTag\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTagTest extends \TestCase
{

    use DatabaseTransactions;

    public function test_can_visit_admin_tags()
    {
        $this->visit('admin/tags')
                ->see('Code Tag');
    }

    public function test_verify_tags_listing()
    {
        Tag::create(['name' => 'Tag01']);
        Tag::create(['name' => 'Tag02']);
        Tag::create(['name' => 'Tag03']);
        Tag::create(['name' => 'Tag04']);

        $this->visit('/admin/tags')
                ->see('Tag01')
                ->see('Tag02')
                ->see('Tag03')
                ->see('Tag04');
    }

    public function test_click_create_new_tag()
    {
        $this->visit('/admin/tags')
                ->click('New Tag')
                ->seePageIs('/admin/tags/create')
                ->see('Create Tag');
    }

    public function test_create_new_tag()
    {
        $this->visit('/admin/tags/create')
                ->type('Tag Test', 'name')
                ->press('Submit')
                ->seePageIs('admin/tags')
                ->see('Tag Test');
    }

    public function test_click_actions_tag()
    {
        $this->visit('/admin/tags')
                ->click('Edit')
                ->see('Edit Tag')
                ->see('Submit')
                ->press('Submit');
        
        $this->visit('/admin/tags')
                ->click('Show')
                ->see('Show Tag');
        
        $this->visit('/admin/tags')
                ->click('Del')
                ->see('Delete Tag')
                ->see('Submit')
                ->press('Submit');
    }

}
