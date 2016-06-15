<?php

namespace CodePress\CodePost\Controllers;

use CodePress\CodePost\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{

    private $repository;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, PostRepositoryInterface $repository)
    {
        $this->responseFactory = $responseFactory;
        $this->repository = $repository;
    }

    public function index()
    {
        $posts = $this->repository->all();
        return $this->responseFactory->view('codepost::index', compact('posts'));
    }

    public function create()
    {
        $posts = $this->repository->all()->lists('name', 'id');
        return $this->responseFactory->view('codepost::create', compact('posts'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->repository->create($data);
        return redirect()->route('admin.posts.index');
    }

    public function edit($id)
    {
        $post = $this->repository->find($id);
        $posts = $this->repository->all();
        return $this->responseFactory->view('codepost::edit', compact('post', 'posts'));
    }

    public function update($id, Request $request)
    {
        $post = $this->repository->update($request->all(), $id);
        return redirect()->route('admin.posts.show',$id);
    }

    public function show($id)
    {
        $post = $this->repository->find($id);
        $comments = $post->comments;
        return $this->responseFactory->view('codepost::show', compact('post', 'comments'));
    }

    public function delete($id)
    {
        $post = $this->repository->find($id);
        return $this->responseFactory->view('codepost::delete', compact('post'));
    }
    public function deleted()
    {
        $posts = $this->repository->deleted();
        return $this->responseFactory->view('codepost::deleted', compact('posts'));
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.posts.index');
    }

}
