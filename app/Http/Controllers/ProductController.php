<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Transformer\ProductTransformer;
use App\Property;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends ApiController
{
    //

    public function index($categoryId)
    {
        $eagerLoad = \Request::get('include');

        if ($eagerLoad == 'properties') {
            $products = Product::with($eagerLoad)->where('category_id', '=', $categoryId)->paginate(10);
            if ($products->isEmpty()) {
                return $this->errorNotFound('No products found');
            }
            return $this->respondWithPagination($products, new ProductTransformer());
        }

        if (!$eagerLoad) {
            $products = Product::where('category_id', '=', $categoryId)->paginate(10);
            if ($products->isEmpty()) {
                return $this->errorNotFound('No products found');
            }
            return $this->respondWithPagination($products, new ProductTransformer());
        }

        if ($eagerLoad != 'properties') {
            return $this->errorWrongArgs('Wrong arguments used');
        }
    }

    public function show($productId)
    {
        $eagerLoad = \Request::get('include');
        $arr = explode(',', $productId); //can request few products
        if ($eagerLoad == 'properties') {
            $products = Product::with($eagerLoad)->find($arr);
            if ($products->isEmpty()) {
                return $this->errorNotFound('Category not found');
            }
            return $this->respondWithCollection($products, new ProductTransformer());
        }
        if (!$eagerLoad) {
            $products = Product::find($arr);
            if ($products->isEmpty()) {
                return $this->errorNotFound('No products found');
            }
            return $this->respondWithCollection($products, new ProductTransformer());
        }

        if ($eagerLoad != 'properties') {
            return $this->errorWrongArgs('Wrong arguments used');
        }
    }
}
