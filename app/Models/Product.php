<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class Product extends Model
{
    //
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'merchant_id'
    ];

    // public $incrementing = false;

    // protected $keyType = 'string';

     /**
     * Automatically generate a UUID when creating a new model instance.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Str::uuid();
            }
        });
    }

    public function marchant() : BelongsTo{
        return $this->belongsTo(Merchant::class);
    }
    
}
