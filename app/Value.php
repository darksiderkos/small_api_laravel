<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    public function property()
    {
        return $this->belongsToMany('App\Property', 'products_properties_values', 'value_id', 'product_id');
    }
}