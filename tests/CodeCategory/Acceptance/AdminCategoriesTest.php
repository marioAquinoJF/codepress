<?php

namespace CodePress\CodeCategory\Testing;

use CodePress\CodeCategory\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCategoriesTest extends \TestCase
{

    use DatabaseTransactions;

    public function test_can_visit_admin_categories()
    {
        $this->visit('/admin/categories')
                ->see('Code Category');
    }

    public function test_verify_categories_listing()
    {
        Category::create(['name' => 'Categroy01', 'active' => true]);
        Category::create(['name' => 'Categroy02', 'active' => true]);
        Category::create(['name' => 'Categroy03', 'active' => true]);
        Category::create(['name' => 'Categroy04', 'active' => true]);

        $this->visit('/admin/categories')
                ->see('Categroy01')
                ->see('Categroy02')
                ->see('Categroy03')
                ->see('Categroy04');
    }

    public function test_click_create_new_category()
    {
        $this->visit('/admin/categories')
                ->click('New Category')
                ->seePageIs('/admin/categories/create')
                ->see('Create Category');
    }

    public function test_create_new_category()
    {
        $this->visit('/admin/categories/create')
                ->type('Category Test', 'name')
                ->check('active')
                ->press('Submit')
                ->seePageIs('admin/categories')
                ->see('Category Test');
    }

    public function test_click_actions_category()
    {
        $this->visit('/admin/categories')
                ->click('Edit')
                ->see('Edit Category')
                ->see('Submit')
                ->press('Submit');

        $this->visit('/admin/categories')
                ->click('Del')
                ->see('Delete Category')
                ->see('Submit')
                ->press('Submit');
        
        $this->visit('/admin/categories')
                ->click('Show')
                ->see('Show Category');
    }

}
