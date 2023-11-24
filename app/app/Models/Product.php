<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','company_id','title', 'cats', 'product_url', 'price', 'sell_price', 'cupon', 'description', 'images',
    ];
}
