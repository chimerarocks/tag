<?php

namespace ChimeraRocks\Tag\Controllers;

use ChimeraRocks\Tag\Models\Tag;
use ChimeraRocks\Tag\Repositories\TagRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
	private $tagRepository;
	private $response;

	public function __construct(TagRepositoryInterface $tagRepository, ResponseFactory $response)
	{
		$this->tagRepository = $tagRepository;
		$this->response = $response;
	}

	public function index()
	{
		return $this->response->view('chimeratag::index', ['tags' => $this->tagRepository->all()]);
	}

	public function create()
	{
		$tags = $this->tagRepository->all();
		return $this->response->view('chimeratag::create', compact('tags'));
	}

	public function store(Request $request)
	{
		$this->tagRepository->create($request->all());
		return redirect()->route('admin.tags.index');
	}
}