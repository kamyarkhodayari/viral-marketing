<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Share;

class ProductsController extends Controller
{
    public function show(Product $product)
    {
        $user_id = request()->input('user');
        if(User::where('id', $user_id)->exists() && !\Auth::user()) {
            //Check ip address
            $ip_address = request()->ip();
            $agent = request()->header('User-Agent');
            if(Share::where('product_id', $product->id)->where('user_id', $user_id)->where('ip_address', $ip_address)->doesntExist()) {
                Share::create([
                    'product_id'    => $product->id,
                    'user_id'       => $user_id,
                    'ip_address'    => $ip_address,
                    'agent'         => $agent
                ]);
            }
        }

        return view('products.view', compact('product'));
    }
}
