@extends('layouts.app.layout')

@section('app')
    <div class="header mb-5">
        <h1 class="heading-1 fw-bolder">{{ config('app.name') }}</h1>
        <h5>Get your discount today!</h5>
    </div>

    <div class="row products">
        @foreach(App\Models\Product::all() as $product)
            <div class="col-lg-3">
                <div class="card product">
                    <div class="card-body">
                        <div class="cover">
                            <img src="{{ $product->cover }}" alt="{{ $product->name }}">
                            <div class="caption">
                                <span class="price text-muted">€ {{ $product->price }}</span>
                                <h4 class="final-price fw-bold mb-0">€ {{ $product->price * (1 - $product->discount / 100) }}</h4>
                            </div>
                        </div>
                        
                        <h5 class="title ">{{ $product->name }}</h5>
                        <span>Share <strong>{{ $product->shares }} times</strong> and get %{{ $product->discount }} discount!</span>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid">
                            <a href="{{ url('/products/view/' . $product->id) }}" class="btn btn-dark">Start viraling!</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
