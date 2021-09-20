<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
                            "product_name", 
                            "product_description", 
                            "product_quantity", 
                            "product_price", 
                            "product_tax",
                            "product_status",
                            "unit_id",
                            "category_id",
                            "brand_id",
                            "user_id"
                        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderProduct::class, "product_id", "order_id");
    }

    
}
