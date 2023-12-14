<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','company_id', 'product_id','title', 'price', 'sell_price', 'cupon', 'description', 'images',
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
