<?php

namespace CodePress\CodeTag\Tests\Controllers;

use CodePress\CodeTag\Tests\AbstractTestCase;
use CodePress\CodeTag\Controllers\AdminTagController;
use CodePress\CodeTag\Controllers\Controller;
use CodePress\CodeTag\Repositories\TagRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminTagControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $repository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagController($responseFactory, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagController($responseFactory, $repository);
        $html = m::mock();

        $tagResult = ['tag1', 'tag2'];
        $repository->shouldReceive('all')
                ->andReturn($tagResult);
        $responseFactory->shouldReceive('view')
                ->with('codetag::index', ['tags' => $tagResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_show_method_and_return_correct_arguments()
    {
        $repository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagController($responseFactory, $repository);
        $html = m::mock();

        $tagResult = $repository;
        $id = 1;
        $repository->shouldReceive('find')
                ->with($id)
                ->andReturn($tagResult);
        $responseFactory->shouldReceive('view')
                ->with('codetag::show', ['tag' => $repository])
                ->andReturn($html);

        $this->assertEquals($controller->show($id), $html);
    }

    
}
