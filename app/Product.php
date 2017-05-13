<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'is_active', 'price', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function properties()
    {
        return $this->belongsToMany('App\Property', 'products_properties_values', 'product_id', 'property_id')
            ->join('values', 'values.id', '=', 'products_properties_values.value_id')
            ->select('properties.name AS name', 'values.value AS value', 'properties.measure AS measure');
    }

    public function scopeFilter($query, $filters)
    {
        switch ($filters['sort']) {
            case 'cheap':
                $query->orderBy('price', 'asc');
                break;
            case 'expensive':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
                $query->latest();
                break;
        };

        if ($filters['price_start']) {
            $priceStart = (float)$filters['price_start'];
            $query->where('price', '>=', $priceStart);
        }

        if ($filters['price_end']) {
            $priceEnd = (float)$filters['price_end'];
            $query->where('price', '<=', $priceEnd);
        }
    }
}