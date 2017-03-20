<?php

namespace App\Http\Transformer;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return[
            'id'=> (int) $product->id,
            'categoryId' => (int) $product->category_id,
            'name' => $product->name,
            'price' => (float) $product->price,
            'description' => $product->description,
            'isActive' => (boolean)$product->is_active,





        ];
    }
}


