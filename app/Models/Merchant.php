<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchant extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'user_id',
        'store_name',
        'store_logo'
    ];

    public function user() : BelongsTo{
       return $this->belongsTo(User::class);
    }

    public function products() : HasMany{
        return $this->hasMany(Product::class);
    }
}
