<?php

namespace CodePress\CodeUser\Controllers;

use CodePress\CodeUser\Repositories\UserRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    private $repository;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, UserRepository $repository)
    {
        $this->responseFactory = $responseFactory;
        $this->repository = $repository;
    }

    public function index()
    {
        $users = $this->repository->all();
        return $this->responseFactory->view('codeuser::index', compact('users'));
    }

    public function create()
    {
        $users = $this->repository->all();
        return $this->responseFactory->view('codeuser::create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->repository->create($data);
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $tag = $this->repository->find($id);
        $users = $this->repository->all()->lists('name', 'id');
        return $this->responseFactory->view('codeuser::edit', compact('user', 'users'));
    }

    public function update($id, Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $tag = $this->repository->find($id)->update($data);
        return redirect()->route('admin.users.show', ['id' => $id]);
    }

    public function show($id)
    {
        $tag = $this->repository->find($id);
        return $this->responseFactory->view('codeuser::show', compact('user'));
    }

    public function delete($id)
    {
        $tag = $this->repository->find($id);
        return $this->responseFactory->view('codeuser::delete', compact('user'));
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.users.index');
    }

}
