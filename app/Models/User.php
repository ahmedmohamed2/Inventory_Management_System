<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ["user_name", "user_password", "full_name", "role_name", "user_status", "user_image"];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
