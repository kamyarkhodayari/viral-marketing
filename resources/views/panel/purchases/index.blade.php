@extends('layouts.panel.layout')

@section('dashboard')
    @include('flash::message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchases</h5>
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
                            <th>With discount</th>
                            <th>Verified</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->product->name }}</td>
                                <td>{{ $purchase->user->name }}</td>
                                <td>
                                    @if($purchase->with_discount)
                                        <span class="badge bg-dark rounded-pill">Yes</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($purchase->verified)
                                        <span class="badge bg-success rounded-pill">Yes</span>
                                    @else
                                        <span class="badge bg-warning rounded-pill">No</span>
                                    @endif
                                </td>
                                <td>{{ $purchase->created_at }}</td>
                                <td>
                                    @if(!$purchase->verified)
                                        @can('verify', App\Models\Purchase::class)
                                            <a href="{{ url('/panel/purchases/verify/'.$purchase->id) }}" class="badge bg-dark rounded-pill text-white text-decoration-none">Verify</a>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection