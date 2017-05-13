<?php

namespace App\Http\Controllers;

use App\Category;
use Validator;
use App\Http\Transformer\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index()
    {
        $paginator = Category::paginate(10);

        return $this->respondWithPagination($paginator, new CategoryTransformer());
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->errorNotAcceptable();
        }

        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return $this->respondWithItem($category, new CategoryTransformer());
    }


    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->errorNotFound('Category not found');
        }

        return $this->respondWithItem($category, new CategoryTransformer());
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->errorNotFound('Category not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'unique:categories|max:255',
            'description' => 'max:255'
        ]);

        if ($validator->fails()) {
            return $this->errorNotAcceptable();
        }

        $category->name = $request->input('name') ?: $category->name;
        $category->description = $request->input('description') ?: $category->description;
        $category->save();

        return $this->respondWithItem($category, new CategoryTransformer());
    }


    public function delete($id)
    {
        //
    }
}