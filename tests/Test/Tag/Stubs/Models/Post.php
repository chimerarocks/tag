<?php

namespace Test\Tag\Stubs\Models;

use ChimeraRocks\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'chimerarocks_posts';

	protected $fillable = [
		'title',
		'content',
		'slug'
	];

	public function tags()
	{
		return $this->morphToMany(Tag::class, 'taggable', 'chimerarocks_taggables');
	}
}