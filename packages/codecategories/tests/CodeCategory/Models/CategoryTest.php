<?php

namespace CodePress\CodeCategory\Tests\Models;

use CodePress\CodeCategory\Tests\AbstractTestCase;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Validation\Validator;
use Mockery as m;

class CategoryTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_category_model()
    {
        $category = new Category();
        $validator = m::mock(Validator::class);
        $category->setValidator($validator);

        $this->assertEquals($category->getValidator(), $validator, 'Validator Injection.');
    }

    // unit test
    public function test_should_if_is_valid_when_it_is()
    {

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')
                ->with(['name' => 'required|255']);
        $validator->shouldReceive('setData')
                ->with(['name' => 'Category Test']);
        $validator->shouldReceive('fails')
                ->andReturn(false);

        $category = new Category();
        $category->name = 'Category Test';
        $category->setValidator($validator);

        $this->assertTrue($category->isValid());
    }

    // unit test
    public function test_should_if_it_is_invalid_when_it_is()
    {

        $validator = m::mock(Validator::class);
        $messageBag = m::mock('Illuminate\Suport\MessageBag');
        $validator->shouldReceive('setRules')
                ->with(['name' => 'required|255']);
        $validator->shouldReceive('setData')
                ->with(['name' => 'Category Test']);
        $validator->shouldReceive('fails')
                ->andReturn(true);
        $validator->shouldReceive('errors')
                ->andReturn($messageBag);

        $category = new Category();
        $category->name = 'Category Test';
        $category->setValidator($validator);

        $this->assertFalse($category->isValid());
        $this->assertEquals($messageBag, $category->errors);
    }

    public function test_check_if_a_category_can_be_persisted()
    {
        $category = Category::create(['name' => 'Category Test', 'active' => true]);
        $this->assertEquals('Category Test', $category->name);

        $category = Category::all()->first();
        $this->assertEquals('Category Test', $category->name);
    }

    public function test_check_if_can_assign_a_parent_to_category()
    {
        $parentCategory = Category::create(['name' => 'Parent Test', 'active' => true]);
        $category = Category::create(['name' => 'Category Test', 'active' => true]);

        $category->parent()->associate($parentCategory)->save();
        $child = $parentCategory->children->first();
        $this->assertEquals('Category Test', $child->name);
        $this->assertEquals('Parent Test', $category->parent->name);
    }

    public function test_check_if_a_category_can_be_updated()
    {
        Category::create(['name' => 'Parent Test', 'active' => true]);
        $category = Category::find(1);
        $category->name = 'Category Test Update';
        $category->active = false;
        $category->save();

        $category = Category::find(1);
        $this->assertEquals('Category Test Update', $category->name);
        $this->assertTrue($category->active == false);
    }

    public function test_check_if_a_category_can_be_searched()
    {
        Category::create(['name' => 'Parent Test retrieved', 'active' => true]);
        $category = Category::where(['name' => 'Parent Test retrieved'])->get();

        $this->assertEquals($category[0] instanceof Category, true);
        $this->assertEquals('Parent Test retrieved', $category[0]->name);
    }

    public function test_check_if_category_is_slagable()
    {
        Category::create(['name' => 'Category Test slaugable', 'active' => true]);
        $category = Category::where(['name' => 'Category Test slaugable'])->get();

        $this->assertNotNull($category[0]->slug);
    }

}
