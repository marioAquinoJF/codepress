<?php

namespace CodePress\CodePost\Controllers;

use CodePress\CodePost\Repositories\CommentRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{

    private $repository;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, CommentRepositoryInterface $repository)
    {
        $this->responseFactory = $responseFactory;
        $this->repository = $repository;
    }

    public function index()
    {
        $comments = $this->repository->all();
        return $this->responseFactory->view('codecomment::index', compact('comments'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->repository->create($data);
        return redirect()->route('admin.comments.index');
    }

    public function edit($id)
    {
        $comment = $this->repository->find($id);
        $comments = $this->repository->all()->lists('name', 'id');
        return $this->responseFactory->view('codepost::comment.edit', compact('comment', 'comments'));
    }

    public function update($id, Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $comment = $this->repository->update($data, $id);
        return redirect()->route('admin.comments.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.comments.index');
    }

}
