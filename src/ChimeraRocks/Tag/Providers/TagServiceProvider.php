<?php

namespace ChimeraRocks\Tag\Providers;

use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{

	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../../resources/migrations/' => base_path('database/migrations')
			],'migrations');

		$this->loadViewsFrom(__DIR__ . '/../../../resources/views/chimeratag', 'chimeratag');

		require __DIR__ . '/../Routes.php';
	}

	/**
     * Register the service provider.
     *
     * @return void
     */
	public function register()
	{
		$this->app->bind(
			\ChimeraRocks\Tag\Repositories\TagRepositoryInterface::class,
				\ChimeraRocks\Tag\Repositories\TagRepositoryEloquent::class
		);
		$this->app->bind(
			\ChimeraRocks\Tag\Models\PostInterface::class,
				\Test\Stubs\Models\Post::class
		);
	}
}