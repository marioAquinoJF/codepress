<?php

namespace CodePress\CodeCategory\Tests\Controllers;

use CodePress\CodeCategory\Tests\AbstractTestCase;
use CodePress\CodeCategory\Controllers\AdminCategoryController;
use CodePress\CodeCategory\Controllers\Controller;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminCategoryControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $category = m::mock(Category::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $category);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $category = m::mock(Category::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $category);
        $html = m::mock();

        $categoryResult = ['cat1', 'cat2'];
        $category->shouldReceive('all')
                ->andReturn($categoryResult);
        $responseFactory->shouldReceive('view')
                ->with('codecategory::index', ['categories' => $categoryResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_show_method_and_return_correct_arguments()
    {
        $category = m::mock(Category::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $category);
        $html = m::mock();

        $categoryResult = $category;
        $id = 1;
        $category->shouldReceive('find')
                ->with($id)
                ->andReturn($categoryResult);
        $responseFactory->shouldReceive('view')
                ->with('codecategory::show', ['category' => $category])
                ->andReturn($html);

        $this->assertEquals($controller->show($id), $html);
    }

    
}
