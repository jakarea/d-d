<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVarient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','company_id', 'product_id','title', 'cats', 'product_url', 'price', 'sell_price', 'cupon', 'description', 'images',
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
