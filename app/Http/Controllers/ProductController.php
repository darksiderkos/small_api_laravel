<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Transformer\ProductTransformer;
use App\Property;
use Illuminate\Http\Request;
use App\Product;
use Validator;

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

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category_id' => 'integer|exists:categories,id|required',
            'name' => 'string|max:255|required|unique:products',
            'price' => 'numeric|required',
            'is_active' => 'boolean',
            'description' => 'string|required'
        ]);

        if ($validator->fails()){
           return $this->errorNotAcceptable();
        }

        $product = new Product($request->all());
        $product->save();
        return $this->respondWithItem($product, new ProductTransformer());
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

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            $this->errorNotFound('Such product not found');
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'integer|exists:categories,id|',
            'name' => 'string|max:255',
            'price' => 'numeric',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorNotAcceptable();
        }

        $product->name = $request->input('name') ?: $product->name;
        $product->category_id = $request->input('category_id') ?: $product->category_id;
        $product->price = $request->input('price') ?: $product->price;
        $product->is_active = $request->has('is_active') ? (boolean)$request->input('is_active') : $product->is_active;
        $product->description = $request->input('description') ?: $product->description;
        $product->save();
        return $this->respondWithItem($product, new ProductTransformer());
    }
}
