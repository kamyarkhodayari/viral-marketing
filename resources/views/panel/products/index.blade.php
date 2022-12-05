@extends('layouts.panel.layout')

@section('dashboard')
    @include('flash::message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Products</h5>
            <div class="actions">
                @can('create', App\Models\Product::class)
                    <a href="{{ url('/panel/products/create') }}" class="btn btn-dark btn-sm">New product</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Shares required</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>€ {{ number_format($product->price) }}</td>
                                <td>%{{ $product->discount }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->shares }}</td>
                                <td>
                                    @can('edit', $product)
                                        <a href="{{ url('/panel/products/edit/'.$product->id) }}" class="badge bg-dark rounded-pill text-white text-decoration-none">Edit</a>
                                    @endcan

                                    @can('delete', $product)
                                        <a href="{{ url('/panel/products/delete/'.$product->id) }}" class="badge bg-danger rounded-pill text-white text-decoration-none" onclick="return confirm('Are you sure?');">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection