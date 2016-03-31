<?php

namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{

    private $category;
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory, Category $category)
    {
        $this->responseFactory = $responseFactory;
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();
        return $this->responseFactory->view('codecategory::index', compact('categories'));
    }

    public function create()
    {        
        $categories = $this->category->all()->lists('name', 'id');
        return $this->responseFactory->view('codecategory::create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $this->category->create($data);
        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $categories = $this->category->all()->lists('name', 'id');
        return $this->responseFactory->view('codecategory::edit', compact('category', 'categories'));
    }

    public function update($id, Request $request)
    {
        $data = array_key_exists('active', $request->all()) ? $request->all() : array_merge($request->all(), ['active' => 'off']);
        $category = $this->category->find($id)->update($data);
        return redirect()->route('admin.categories.show', ['id' => $id]);
    }

    public function show($id)
    {
        $category = $this->category->find($id);
        return $this->responseFactory->view('codecategory::show', compact('category'));
    }

    public function delete($id)
    {
        $category = $this->category->find($id);
        return $this->responseFactory->view('codecategory::delete', compact('category'));
    }

    public function destroy($id)
    {
        $this->category->destroy($id);
        return redirect()->route('admin.categories.index');
    }

}
