<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_id',
        'user_id',
        'replies_to',
        'review',
        'rating'
    ];

    protected $hidden = [ 
        'created_at',
        'updated_at',
    ];


    public function likes():HasMany
    {
        return $this->hasMany(Like::class)->where('like', true);
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product() 
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function likeStatus()
    {
        return $this->hasOne(Like::class)->where('user_id', auth()->user()->id);
    }

    public function dislikes():HasMany
    {
        return $this->hasMany(Like::class)->where('like', false);
    } 
}
