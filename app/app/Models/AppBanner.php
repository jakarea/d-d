<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner','banner_type','created_by'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_at',
    ];
}
