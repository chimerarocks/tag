<?php

namespace Test\Tag\Models;

use ChimeraRocks\Tag\Models\Tag;
use Illuminate\Validation\Validator;
use Mockery;
use Test\AbstactTestCase;
use Test\Tag\Stubs\Models\Post;

class TagTest extends AbstactTestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->migrate();
	}

	public function test_inject_validator_in_tag_model()
	{
		$tag = new Tag();
		$validator = Mockery::mock(Validator::class);
		$tag->setValidator($validator);

		$this->assertEquals($tag->getValidator(), $validator);
	}

	public function test_should_check_if_it_is_valid_when_it_is()
	{
		$tag = new Tag();
		$tag->name = "Tag Test";

		$validator = Mockery::mock(Validator::class);
		$validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
		$validator->shouldReceive('setData')->with(['name' => 'Tag Test']);
		$validator->shouldReceive('fails')->andReturn(false);

		$tag->setValidator($validator);

		$this->assertTrue($tag->isValid());
	}

	public function test_should_check_if_it_is_invalid_when_it_is()
	{
		$tag = new Tag();
		$tag->name = "Tag Test";

		$messagebag = Mockery::mock(Illuminate\Support\MessageBag::class);

		$validator = Mockery::mock(Validator::class);
		$validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
		$validator->shouldReceive('setData')->with(['name' => 'Tag Test']);
		$validator->shouldReceive('fails')->andReturn(true);
		$validator->shouldReceive('errors')->andReturn($messagebag);

		$tag->setValidator($validator);

		$this->assertFalse($tag->isValid());
		$this->assertEquals($messagebag, $tag->errors);
	}

	public function test_check_if_a_tag_can_be_persisted()
	{
		$tag = Tag::create(['name' => 'TagTest']);

		$this->assertEquals('TagTest', $tag->name);

		$tag = Tag::all()->first();

		$this->assertEquals('TagTest', $tag->name);
	}

	public function test_can_add_posts_to_tags()
	{
		$category = Tag::create(['name' => 'Tag', 'active' => true]);
		$post = Post::create(['title' => 'my post 1']);
		$post2 = Post::create(['title' => 'my post 2']);

		$post->tags()->save($category);
		$post2->tags()->save($category);

		$tags = Tag::all();

		$this->assertCount(1, $tags);
		$this->assertEquals('Tag', $post->tags->first()->name);
		$this->assertEquals('Tag', $post2->tags->first()->name);
		$posts = Tag::find(1)->posts;
		$this->assertCount(2, $posts);
		$this->assertEquals('my post 1', $posts[0]->title);
		$this->assertEquals('my post 2', $posts[1]->title);
	}
}