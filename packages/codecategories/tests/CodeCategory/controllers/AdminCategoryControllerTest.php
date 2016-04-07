<?php

namespace CodePress\CodeCategory\Tests\Controllers;

use CodePress\CodeCategory\Tests\AbstractTestCase;
use CodePress\CodeCategory\Controllers\AdminCategoryController;
use CodePress\CodeCategory\Controllers\Controller;
use CodePress\CodeCategory\Repositories\CategoryRepository;
use CodePress\CodeCategory\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminCategoryControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(CategoryRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = m::mock(CategoryRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $repository);
        $html = m::mock();

        $categoryResult = ['cat1', 'cat2'];
        $repository->shouldReceive('all')
                ->andReturn($categoryResult);
        $responseFactory->shouldReceive('view')
                ->with('codecategory::index', ['categories' => $categoryResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_show_method_and_return_correct_arguments()
    {
        $repository = m::mock(CategoryRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $repository);
        $html = m::mock();

        $categoryResult = $repository;
        $id = 1;
        $repository->shouldReceive('find')
                ->with($id)
                ->andReturn($categoryResult);
        $responseFactory->shouldReceive('view')
                ->with('codecategory::show', ['category' => $repository])
                ->andReturn($html);

        $this->assertEquals($controller->show($id), $html);
    }

}
