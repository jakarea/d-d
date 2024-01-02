<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_packages_id','company_id','user_id','package_name','amount','payment_id','package_type','start_at','end_at','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function myPackage()
    {
        return $this->hasOne(PricingPackage::class, 'id', 'pricing_packages_id');
    }
}