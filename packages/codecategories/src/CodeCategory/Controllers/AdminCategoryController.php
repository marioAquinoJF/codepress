<?php

namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Repositories\CategoryRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{

    private $repository;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, CategoryRepository $repository)
    {
        $this->responseFactory = $responseFactory;
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->all();
        return $this->responseFactory->view('codecategory::index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->repository->all()->lists('name', 'id');
        return $this->responseFactory->view('codecategory::create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->repository->create($data);
        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);
        $categories = $this->repository->all()->lists('name', 'id');
        return $this->responseFactory->view('codecategory::edit', compact('category', 'categories'));
    }

    public function update($id, Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $category = $this->repository->update($data, $id);
        return redirect()->route('admin.categories.show', ['id' => $id]);
    }

    public function show($id)
    {
        $category = $this->repository->find($id);
        return $this->responseFactory->view('codecategory::show', compact('category'));
    }

    public function delete($id)
    {
        $category = $this->repository->find($id);
        return $this->responseFactory->view('codecategory::delete', compact('category'));
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.categories.index');
    }

}
