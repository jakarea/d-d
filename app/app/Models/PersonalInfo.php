<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'avatar',
        'gender',
        'designation',
        'maritual_status',
        'dob',
        'phone',
        'nationality',
        'email',
    ];
}
