<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'yearly_price',
        'package_type',
        'features',
        'status',
        'is_featured',
        'created_by'
    ];

    public function user() {
        return $this->hasOne(User::class, 'created_by', 'id');
    }

    public function myPurchaseInfo() {
        return $this->hasOne(Earning::class, 'pricing_packages_id', 'id')
            ->where('status', 'paid') 
            ->where('end_at', '>', now())
            ->where('user_id', auth()->id());
    }
    
}
