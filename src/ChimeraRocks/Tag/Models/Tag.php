<?php

namespace ChimeraRocks\Tag\Models;

use ChimeraRocks\Tag\Models\Contracts\PostInterface;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Tag extends Model
{
	protected $table = "chimerarocks_tags";
	private $validator;

	protected $fillable = [
		'name',
	];

	public function setValidator(Validator $validator)
	{
		$this->validator = $validator;
	}

	public function getValidator()
	{
		return $this->validator;
	}

	public function isValid()
	{
		$validator = $this->validator;
		$validator->setRules(['name' => 'required|max:255']);
		$validator->setData($this->attributes);

		if ($validator->fails()) {
			$this->errors = $validator->errors();
			return false;
		}
		return true;
	}

	public function posts()
	{
		$post = App::make(PostInterface::class);
		return $this->morphedByMany($post, 'taggable', 'chimerarocks_taggables');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}