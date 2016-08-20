<?php

namespace ChimeraRocks\Tag\Controllers;

use ChimeraRocks\Tag\Models\Tag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
	private $tag;
	private $response;

	public function __construct(Tag $tag, ResponseFactory $response)
	{
		$this->tag = $tag;
		$this->response = $response;
	}

	public function index()
	{
		return $this->response->view('chimeratag::index', ['tags' => $this->tag->all()]);
	}

	public function create()
	{
		$tags = $this->tag->all();
		return $this->response->view('chimeratag::create', compact('tags'));
	}

	public function store(Request $request)
	{
		$this->tag->create($request->all());
		return redirect()->route('admin.tags.index');
	}
}