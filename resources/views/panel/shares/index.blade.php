@extends('layouts.panel.layout')

@section('dashboard')
    @include('flash::message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Shares</h5>
            <div class="actions">
                {{-- To be completed --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>User</th>
                            <th>IP address</th>
                            <th>Agent</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shares as $share)
                            <tr>
                                <td>{{ $share->product->name }}</td>
                                <td>{{ $share->user->name }}</td>
                                <td>{{ $share->ip_address }}</td>
                                <td>{{ $share->agent }}</td>
                                <td>{{ $share->created_at }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection