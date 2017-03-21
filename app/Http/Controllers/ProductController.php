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

        if ($eagerLoad) {
            $products = Product::with($eagerLoad)->where('category_id', '=', $categoryId)->get();
            if ($products->isEmpty()) {
                return $this->errorNotFound();
            }
            return $this->respondWithCollection($products, new ProductTransformer());


        } else {
            $products = Product::where('category_id', '=', $categoryId)->get();
            if ($products->isEmpty()) {
                return $this->errorNotFound();
            }
            return $this->respondWithCollection($products, new ProductTransformer());
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
