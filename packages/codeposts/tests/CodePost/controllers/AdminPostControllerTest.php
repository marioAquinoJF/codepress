<?php

namespace CodePress\CodePost\Tests\Controllers;

use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodePost\Controllers\AdminPostController;
use CodePress\CodePost\Controllers\Controller;
use CodePress\CodePost\Repositories\PostRepositoryInterface;
use CodePress\CodePost\Models\Post;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminPostControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(PostRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminPostController($responseFactory, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = m::mock(PostRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminPostController($responseFactory, $repository);
        $html = m::mock();

        $postResult = ['cat1', 'cat2'];
        $repository->shouldReceive('all')
                ->andReturn($postResult);
        $responseFactory->shouldReceive('view')
                ->with('codepost::index', ['posts' => $postResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_show_method_and_return_correct_arguments()
    {
        $repository = m::mock(PostRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminPostController($responseFactory, $repository);
        $html = m::mock();

        $postResult = $repository;
        $id = 1;
        $repository->shouldReceive('find')
                ->with($id)
                ->andReturn($postResult);
        $responseFactory->shouldReceive('view')
                ->with('codepost::show', ['post' => $repository])
                ->andReturn($html);

        $this->assertEquals($controller->show($id), $html);
    }

}
