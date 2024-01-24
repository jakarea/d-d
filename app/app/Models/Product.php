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
        'user_id', 'company_id', 'title', 'cats', 'product_url', 'price', 'status', 'sell_price', 'cupon', 'description', 'deal_type', 'deal_expired_at', 'is_deal_expired', 'location', 'location_latitude', 'location_longitude', 'images',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(WishList::class);
    }

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
}
