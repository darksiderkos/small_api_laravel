<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Transformer\ProductTransformer;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends ApiController
{
    //


    public function index()
    {
        $products = Product::paginate(10);
        return $this->respondWithCollection($products, new ProductTransformer());

    }

    public function show($productId)
    {
        $product = Product::find($productId);
        if (!$product){
            return $this->errorNotFound();
        }
        return $this->respondWithItem($product, new ProductTransformer());
    }
}
