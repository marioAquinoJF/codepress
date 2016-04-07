<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Repositories\TagRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{

    private $repository;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, TagRepository $repository)
    {
        $this->responseFactory = $responseFactory;
        $this->repository = $repository;
    }

    public function index()
    {
        $tags = $this->repository->all();
        return $this->responseFactory->view('codetag::index', compact('tags'));
    }

    public function create()
    {
        $tags = $this->repository->all();
        return $this->responseFactory->view('codetag::create', compact('tags'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->repository->create($data);
        return redirect()->route('admin.tags.index');
    }

    public function edit($id)
    {
        $tag = $this->repository->find($id);
        $tags = $this->repository->all()->lists('name', 'id');
        return $this->responseFactory->view('codetag::edit', compact('tag', 'tags'));
    }

    public function update($id, Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $tag = $this->repository->find($id)->update($data);
        return redirect()->route('admin.tags.show', ['id' => $id]);
    }

    public function show($id)
    {
        $tag = $this->repository->find($id);
        return $this->responseFactory->view('codetag::show', compact('tag'));
    }

    public function delete($id)
    {
        $tag = $this->repository->find($id);
        return $this->responseFactory->view('codetag::delete', compact('tag'));
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.tags.index');
    }

}
