@extends('layouts.app.layout')

@section('app')
    <div class="row">
        <div class="col-lg-4">
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
                        @foreach($product->images->where('is_cover', false) as $image)
                        <div class="col-3 slider-image">
                            <img src="{{ $image->url }}" alt="">
                        </div>
                        @endforeach
                    </div>

                    <span>Share <strong>{{ $product->shares }} times</strong> and get %{{ $product->discount }} discount!</span>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <h1 class="title">{{ $product->name }}</h1>
            <div class="description">
                {!! nl2br($product->description) !!}
            </div>
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
                var image = $(this).find('img');
                var url = image.attr('src');
                var cover = $('.cover').find('img');
                cover.attr('src', url);
            });
        </script>
    @append
@endsection