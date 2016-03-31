<?php

namespace CodePress\CodeTag\Tests\Controllers;

use CodePress\CodeTag\Tests\AbstractTestCase;
use CodePress\CodeTag\Controllers\AdminTagController;
use CodePress\CodeTag\Controllers\Controller;
use CodePress\CodeTag\Models\Tag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery as m;

class AdminTagControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller()
    {
        $tag = m::mock(Tag::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagController($responseFactory, $tag);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $tag = m::mock(Tag::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagController($responseFactory, $tag);
        $html = m::mock();

        $tagResult = ['tag1', 'tag2'];
        $tag->shouldReceive('all')
                ->andReturn($tagResult);
        $responseFactory->shouldReceive('view')
                ->with('codetag::index', ['tags' => $tagResult])
                ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_show_method_and_return_correct_arguments()
    {
        $tag = m::mock(Tag::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagController($responseFactory, $tag);
        $html = m::mock();

        $tagResult = $tag;
        $id = 1;
        $tag->shouldReceive('find')
                ->with($id)
                ->andReturn($tagResult);
        $responseFactory->shouldReceive('view')
                ->with('codetag::show', ['tag' => $tag])
                ->andReturn($html);

        $this->assertEquals($controller->show($id), $html);
    }

    
}
