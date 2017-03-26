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
            $products = Product::with($eagerLoad)->where('category_id', '=', $categoryId)->get();
            if ($products->isEmpty()) {
                return $this->errorNotFound('No products found');
            }
            return $this->respondWithCollection($products, new ProductTransformer());
        }

        if (!$eagerLoad) {
            $products = Product::where('category_id', '=', $categoryId)->get();
            if ($products->isEmpty()) {
                return $this->errorNotFound('No products found');
            }
            return $this->respondWithCollection($products, new ProductTransformer());
        }

        if ($eagerLoad != 'properties') {
            return $this->errorWrongArgs('Wrong arguments used');
        }

    }

    public
    function show($productId)
    {
        $arr = explode(',', $productId); //can request few products
        $product = Product::find($arr);
        if (!$product) {
            return $this->errorNotFound();
        }
        return $this->respondWithCollection($product, new ProductTransformer());
    }
}
