<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Transformer\CategoryTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CategoryController extends ApiController
{

    public function index()
    {
//        $manager = new Manager();

        $paginator = Category::paginate(5);
        return $this->respondWithPagination($paginator, new CategoryTransformer());

//        $categories = $paginator->getCollection();
//
//        $resource = new Collection($categories, new CategoryTransformer);
//        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
//        $data = $manager->createData($resource)->toJson();
//        return response($data, 200, ['Content-type' => 'application/json']);
    }


    public function create(Request $request)
    {
        //
    }


    public function show($id)
    {
        $category = Category::find($id);
        if (!$category){
            return $this->errorNotFound('Category not found');
        }
        return $this->respondWithItem($category, new CategoryTransformer());
    }


    public function update(Request $request, $id)
    {

    }


    public function delete($id)
    {
        //
    }
}
