<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;

class PurchasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('index', Purchase::class);

        $purchases = Purchase::query();

        //Filters and the rest

        $purchases = $purchases->orderBy('created_at', 'desc')->paginate(20);

        return view('panel.purchases.index', compact('purchases'));
    }

    public function create(Product $product)
    {
        if(!($product->stock > 0)) {
            flash('Product '. $product->name .' is sold out.')->warning();
            return redirect()->route('index');
        }
        
        if(Purchase::where('product_id', $product->id)->where('user_id', auth()->user()->id)->exists()) {
            flash('You have already requested for purchase for this product. Please wait for our response.')->warning();
            return redirect()->back();
        }

        $shares = auth()->user()->shares->where('product_id', $product->id)->count();
        $discount = ($shares >= $product->shares) ? true : false;

        $purchase = Purchase::create([
            'product_id'    => $product->id,
            'user_id'       => auth()->user()->id,
            'with_discount' => $discount
        ]);

        flash('Thank you for your purchase! We will be in touch with you for processing payment and delivering the product.')->success();
        return redirect('/products/view/'.$product->id);
    }

    public function verify(Purchase $purchase)
    {
        $this->authorize('verify', Purchase::class);

        $purchase->update([
            'verified'  => true
        ]);

        $purchase->product()->update([
            'stock' => $purchase->product->stock - 1
        ]);

        flash('Purchase verified successfully.')->success();
        return redirect()->back();
    }
}
