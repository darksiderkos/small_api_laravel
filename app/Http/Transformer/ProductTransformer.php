<?php

namespace App\Http\Transformer;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'properties'
    ];

    public function transform(Product $product)
    {
        return[
            'id'=> (int) $product->id,
            'category_id' => (int) $product->category_id,
            'name' => $product->name,
            'price' => (float) $product->price,
            'description' => $product->description,
            'is_active' => (boolean)$product->is_active,
        ];
    }

    public function includeProperties(Product $product)
    {
        $properties = $product->properties;

        return $this->collection($properties, new PropertyTransformer);
    }
}