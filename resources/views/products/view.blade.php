@extends('layouts.app.layout')

@section('title', $product->name)
@section('og_title', config('app.name') . ' - ' . $product->name)
@section('og_image', $product->images->where('is_cover')->first()->url)

@section('app')
    <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card product single-product">
                <div class="card-body">
                    <div class="cover">
                        <img src="{{ $product->cover }}" alt="{{ $product->name }}">
                        <div class="caption">
                            <span class="price text-muted">€ {{ $product->price }}</span>
                            <h4 class="final-price fw-bold mb-0">€ {{ round($product->price * (1 - $product->discount / 100), 2) }}</h4>
                        </div>
                    </div>

                    <div class="slider row">
                        @foreach($product->images as $image)
                        <div class="col-3 slider-image @if($image->is_cover) active @endif">
                            <img src="{{ $image->url }}" alt="">
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center">Share <strong>{{ $product->shares }} times</strong> and get <strong class="text-success">%{{ $product->discount }} discount!</strong></div>
                    <div class="divider">
                        <span>OR</span>
                    </div>
                    <div class="d-grid">
                        <a href="{{ url('/panel/purchases/create/'.$product->id) }}" class="btn btn-dark">Buy it without discount!</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('flash::message')
            
            <h1 class="title">{{ $product->name }}</h1>
            <div class="description mb-4">
                {!! nl2br($product->description) !!}
            </div>

            @guest
                <div class="alert alert-light" role="alert">
                    <h4 class="alert-heading">How does this work?</h4>
                    <p>By logging in your account, or registring, you get your own link for each product. You can then start sharing the your personal link. When your link has opened as many times as the limitation of your desired product, you unlock the discount for the product. You can then use your discount to purchase that product.</p>
                    <hr>
                    <p class="mb-0"><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">register</a> to start sharing and unlock your discount.</p>
                </div>
            @endguest

            @auth
                <div class="card">
                    @if(auth()->user()->shares->where('product_id', $product->id)->count() >= $product->shares)
                        <div class="card-body">
                            <h5 class="fw-bolder">Congrats!</h5>
                            <p>You got the discount! You can request for purchase now.</p>

                            <a href="{{ url('/panel/purchases/create/'.$product->id) }}" class="btn btn-dark">Purchase now</a>
                        </div>
                    @else
                        <div class="card-header">
                            @if(auth()->user()->shares->where('product_id', $product->id)->isEmpty())
                                <h5 class="mb-0">Start sharing now!</h5>
                            @else
                                <h5 class="mb-0">You shared this product <span class="fw-bolder">{{ auth()->user()->shares->where('product_id', $product->id)->count() }} time(s)!</span></h5>
                            @endif
                            
                            <span>{{ $product->shares - auth()->user()->shares->where('product_id', $product->id)->count() }} to go.</span>
                        </div>
                        <div class="card-body">
                            <div class="row gx-3 gy-2 align-items-end">
                                <div class="col-lg-10">
                                    <label for="personal_link">Your personal link for this product</label>
                                    <input type="text" name="personal_link" class="form-control" value="{{ url('/products/view/'.$product->id.'?user='.auth()->user()->id) }}" readonly>
                                </div>
                                <div class="col-lg-2">
                                    <div class="d-grid">
                                        <a href="#" id="copyToClipboard" class="btn btn-dark">Copy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endauth
        </div>
    </div>

    @section('scripts')
        <script>
            $(function() {
                $('.slider-image').each(function(index) {
                    var image = $(this).find('img');
                    var imageWidth = image.outerWidth();
                    image.css('height', imageWidth);
                });
            });

            $(document).on('click', '.slider-image', function(event) {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var image = $(this).find('img');
                var url = image.attr('src');
                var cover = $('.cover').find('img');
                cover.attr('src', url);
            });

            $(document).on('click', '#copyToClipboard', function(event) {
                event.preventDefault();
                $("input[name='personal_link']").select();
                document.execCommand("copy");
            });
        </script>
    @append
@endsection