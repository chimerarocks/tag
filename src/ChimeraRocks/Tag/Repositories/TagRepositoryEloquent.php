<?php

namespace ChimeraRocks\Tag\Repositories;

use ChimeraRocks\Database\AbstractEloquentRepository;
use ChimeraRocks\Tag\Models\Tag;
use ChimeraRocks\Tag\Repositories\TagRepositoryInterface;

class TagRepositoryEloquent extends AbstractEloquentRepository implements TagRepositoryInterface
{
	public function model()
	{
		return Tag::class;
	}
}