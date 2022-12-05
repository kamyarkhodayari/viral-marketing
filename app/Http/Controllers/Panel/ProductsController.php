<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Storage;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Product::class);

        $products = Product::query();

        //Filters and the rest

        $products = $products->orderBy('created_at', 'desc')->paginate(20);

        return view('panel.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        $product = new Product;

        return view('panel.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validator = $request->validate([
            'name'              => 'required|string',
            'price'             => 'required|numeric|min:0',
            'description'       => 'nullable|string',
            'discount'          => 'required|integer|min:0|max:100',
            'stock'             => 'required|integer|min:0',
            'shares'            => 'required|integer|min:0',
            'images'            => 'required|array|min:1',
            'images.*.file'     => 'required|file|mimes:jpg,png',
            'images.*.is_cover' => 'sometimes|boolean',
        ]);

        $product = Product::create($request->all());

        $this->handleImages($request, $product);

        flash('Product created successfully.')->success();
        return redirect()->route('panel_products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('edit', $product);

        return view('panel.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('edit', $product);

        $validator = $request->validate([
            'name'              => 'required|string',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'discount'          => 'required|integer|min:0|max:100',
            'stock'             => 'required|integer|min:0',
            'shares'            => 'required|integer|min:0',
            'images'            => 'required|array|min:1',
            'images.*.file'     => 'nullable|file|mimes:jpg,png',
            'images.*.is_cover' => 'sometimes|boolean',
        ]);

        $product->update($request->all());

        $this->handleImages($request, $product);

        flash('Product modified successfully.')->success();
        return redirect()->route('panel_products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function handleImages(Request $request, Product $product)
    {
        $images = $request->input('images');

        if($images) {
            $newImages = [];
            $existingImages = [];

            foreach($images as $key => $image) {
                if(isset($image['id']) && !empty($image['id'])) {
                    array_push($existingImages, $image['id']);

                    //Handling cover property
                    $target = Image::where('id', $image['id'])->first();
                    $target->update([
                        'is_cover'  => isset($image['is_cover']) ?? false
                    ]);
                } else {
                    $path = $request->file('images.'.$key.'.file')->store('/products/product_'. $product->id);
                    $image['url'] = url(Storage::url($path));

                    array_push($newImages, $image);
                }
            }

            //Handling deleted images
            $deletedImages = array_diff($product->images->pluck('id')->toArray(), $existingImages);
            $product->images()->whereIn('id', $deletedImages)->delete();

            //Handling new images
            $product->images()->createMany($newImages);
        }
    }
}
