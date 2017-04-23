<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
//    protected $hidden = array('id');
    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
