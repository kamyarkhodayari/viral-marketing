<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'with_discount',
        'verified'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id')->withDefault();
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')->withDefault();
    }
}
