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
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
