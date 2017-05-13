<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $hidden = array('pivot');

    public function products()
    {
        return $this->belongsToMany('App\Product', 'products_properties_values', 'property_id', 'product_id');
    }

    public function value()
    {
        return $this->belongsToMany('App\Value', 'products_properties_values', 'property_id', 'value_id');
    }
}