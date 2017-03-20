<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
//    protected $hidden = ['category_id', 'id'];

//    protected $with = ['properties'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function properties()
    {
        return $this->belongsToMany('App\Property', 'products_properties_values', 'product_id', 'property_id')
            ->join('values', 'values.id' , '=' , 'products_properties_values.value_id')
            ->select('properties.name AS name', 'values.value AS value', 'properties.measure AS measure');
    }

}
