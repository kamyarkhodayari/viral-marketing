<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'ip_address',
        'agent'
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
