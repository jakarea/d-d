<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id','receiver_id','type','action_id','action_link','message','status','role'
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'action_id');
    }
}
