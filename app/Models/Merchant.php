<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Merchant extends Model
{
    
    protected $fillable = [
        'user_id',
        'store_name',
        'store_logo'
    ];

    public function user() : BelongsTo{
       return $this->belongsTo(User::class);
    }
}
