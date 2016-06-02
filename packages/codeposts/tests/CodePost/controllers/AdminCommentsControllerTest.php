<?php

namespace CodePress\CodePost\Tests\Controllers;

use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodePost\Controllers\AdminCommentsController;
use CodePress\CodePost\Controllers\Controller;
use CodePress\CodePost\Repositories\CommentRepositoryInterface;
use CodePress\CodePost\Models\Comment;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminCommentsControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(CommentRepositoryInterface::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCommentsController($responseFactory, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

}
