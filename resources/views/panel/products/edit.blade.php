@extends('layouts.panel.layout')

@section('dashboard')
    @include('layouts.panel.errors')
    <form action="{{ url('/panel/products/edit/'. $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit {{ $product->name }}</h5>
                <div class="actions">
                    <a href="{{ route('panel_products') }}" class="btn btn-light btn-sm">Back</a>
                    <button type="submit" class="btn btn-dark btn-sm">Update</button>
                </div>
            </div>
            <div class="card-body">
                @include('panel.products.form')
            </div>
        </div>
    </form>
@endsection