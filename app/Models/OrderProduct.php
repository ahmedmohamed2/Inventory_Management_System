<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table        = "orders_products";
    protected $fillable     = ["quantity", "price", "tax", "order_id", "product_id"];

    
}
