@extends('layouts.main')

@section('content')
    @include('layouts.panel.navbar')

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('dashboard')
                </div>
            </div>
        </div>
    </main>
@endsection