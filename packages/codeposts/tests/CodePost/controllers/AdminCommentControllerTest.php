<?php

namespace CodePress\CodePost\Tests\Controllers;

use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodePost\Controllers\AdminCommentController;
use CodePress\CodePost\Controllers\Controller;
use CodePress\CodePost\Repositories\CommentRepositoryInterface;
use CodePress\CodePost\Models\Comment;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminCommentControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(CommentRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCommentController($responseFactory, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = m::mock(CommentRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCommentController($responseFactory, $repository);
        $html = m::mock();

        $commentResult = ['cat1', 'cat2'];
        $repository->shouldReceive('all')
                ->andReturn($commentResult);
        $responseFactory->shouldReceive('view')
                ->with('codecomment::index', ['comments' => $commentResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_show_method_and_return_correct_arguments()
    {
        $repository = m::mock(CommentRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCommentController($responseFactory, $repository);
        $html = m::mock();

        $commentResult = $repository;
        $id = 1;
        $repository->shouldReceive('find')
                ->with($id)
                ->andReturn($commentResult);
        $responseFactory->shouldReceive('view')
                ->with('codecomment::show', ['comment' => $repository])
                ->andReturn($html);

        $this->assertEquals($controller->show($id), $html);
    }

}
