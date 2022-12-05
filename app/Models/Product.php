<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'stock',
        'shares'
    ];

    protected $appends = [
        'cover'
    ];

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_id');
    }

    public function sharings()
    {
        return $this->hasMany('App\Models\Share', 'product_id');
    }

    public function getCoverAttribute()
    {
        if(!$this->images->where('is_cover', true)->isEmpty()) {
            return $this->images->where('is_cover', true)->first()->url;
        }

        return null;
    }
}
