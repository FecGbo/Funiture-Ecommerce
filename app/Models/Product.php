<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'product_code',
        'purchase_price',
        'sale_price',
        'stock',
        'image',
        'description',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
