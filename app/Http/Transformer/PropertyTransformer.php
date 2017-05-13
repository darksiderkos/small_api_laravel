<?php


namespace App\Http\Transformer;

use App\Property;
use League\Fractal\TransformerAbstract;

class PropertyTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'value'
    ];

    public function transform(Property $property)
    {
        return [
            'property_name' => $property->name,
            'property_value' =>(float) $property->value,
            'property_measure' => $property->measure,
        ];
    }


    public function includeValue(Property $property)
    {
        $value = $property->value;

        return $this->item($value, new ValueTransformer);
    }
}