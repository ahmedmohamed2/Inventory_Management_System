<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ["brand_name", "brand_status", "category_id"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
