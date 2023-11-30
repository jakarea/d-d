<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'tagline','about','email','phone','country','location','slug','user_id'
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderByDesc('id');
    }

    public function reviews():HasMany
    {
        return $this->hasMany(Review::class);
    }
}
