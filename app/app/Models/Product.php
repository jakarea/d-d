<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','company_id','title', 'cats', 'product_url', 'price', 'sell_price', 'cupon', 'description', 'images',
    ];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function productVarients():HasMany
    {
        return $this->hasMany(ProductVarient::class);
    }
}
