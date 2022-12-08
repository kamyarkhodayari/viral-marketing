@extends('layouts.panel.layout')

@section('dashboard')
    <h5 class="mb-3">Welcome {{ auth()->user()->name }}!</h5>
    
    @if(auth()->user()->role == 1)
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2>{{ App\Models\User::where('role', 0)->count() }}</h2>
                        <span>Users</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2>{{ App\Models\Product::count() }}</h2>
                        <span>Products</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2>{{ App\Models\Share::count() }}</h2>
                        <span>Shares</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection