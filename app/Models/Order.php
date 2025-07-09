<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'order_date',
        'customer_id',
        'status',
    ];


    public function products()
    {
        return $this->belongsToMany(
            Product::class,      // The related model
            'orders_details',    // The pivot table name
            'order_id',          // Foreign key on the pivot table for the current model (Order)
            'product_id'         // Foreign key on the pivot table for the related model (Product)
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
