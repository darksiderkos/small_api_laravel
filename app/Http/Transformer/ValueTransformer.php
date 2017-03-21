<?php


namespace App\Http\Transformer;

use App\Value;
use League\Fractal\TransformerAbstract;

class ValueTransformer extends TransformerAbstract
{

    public function transform(Value $value)
    {
        return [
            'value' => (float) $value->value,
        ];
    }

}