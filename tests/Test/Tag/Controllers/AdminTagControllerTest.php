<?php

namespace Test\Tag\Controllers;

use ChimeraRocks\Tag\Controllers\AdminTagController;
use ChimeraRocks\Tag\Controllers\Controller;
use ChimeraRocks\Tag\Repositories\TagRepositoryEloquent;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery;
use Test\AbstactTestCase;

class AdminTagControllerTest extends AbstactTestCase
{
	public function test_should_extends_from_controller()
	{
		$tagRepository = Mockery::mock(TagRepositoryEloquent::class);
		$response = Mockery::mock(ResponseFactory::class);

		$controller = new AdminTagController($tagRepository, $response);

		$this->assertInstanceOf(Controller::class, $controller);
	}

	public function test_controller_should_run_index_method_and_return_correct_arguments()
	{
		$tagRepository = Mockery::mock(TagRepositoryEloquent::class);
		$response = Mockery::mock(ResponseFactory::class);
		$html = Mockery::mock();

		$controller = new AdminTagController($tagRepository, $response);

		$tagsResult = ['Tag1', 'Tag2'];
		$tagRepository->shouldReceive('all')->andReturn($tagsResult);
		$response->shouldReceive('view')
		    ->with('chimeratag::index', ['tags' => $tagsResult])
		    ->andReturn($html);

		$this->assertEquals($controller->index(), $html);
	}
}