@extends('layouts.panel.layout')

@section('dashboard')
    @include('flash::message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users</h5>
            <div class="actions">
                {{-- To be completed --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 1)
                                        <span class="badge bg-success rounded-pill">Admin</span>
                                    @else
                                        <span class="badge bg-primary rounded-pill">Client</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->role != 1)
                                        @can('promote', App\Models\User::class)
                                            <a href="{{ url('/panel/users/promote/'.$user->id) }}" class="badge bg-dark rounded-pill text-white text-decoration-none">Promote</a>
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