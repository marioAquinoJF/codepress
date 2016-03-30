<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Models\Tag;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{

    private $tag;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, Tag $tag)
    {
        $this->responseFactory = $responseFactory;
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->all();
        return $this->responseFactory->view('codetag::index', compact('tags'));
    }

    public function create()
    {
        $tags = $this->tag->all();
        return $this->responseFactory->view('codetag::create', compact('tags'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->tag->create($data);
        return redirect()->route('admin.tags.index');
    }

    public function edit($id)
    {
        $tag = $this->tag->find($id);
        $tags = $this->tag->all()->lists('name', 'id');
        return $this->responseFactory->view('codetag::edit', compact('tag', 'tags'));
    }

    public function update($id, Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $tag = $this->tag->find($id)->update($data);
        return redirect()->route('admin.tags.show', ['id' => $id]);
    }

    public function show($id)
    {
        $tag = $this->tag->find($id);
        return $this->responseFactory->view('codetag::show', compact('tag'));
    }

    public function delete($id)
    {
        $tag = $this->tag->find($id);
        return $this->responseFactory->view('codetag::delete', compact('tag'));
    }

    public function destroy($id)
    {
        $this->tag->destroy($id);
        return redirect()->route('admin.tags.index');
    }

}
