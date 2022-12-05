@extends('layouts.main')

@section('content')
    @include('layouts.app.navbar')
    <div class="wrapper container py-5">
        @yield('app')
    </div>

    @section('scripts')
        <script>
            $(function() {
                var navbarHeight = $('#mainNavbar').outerHeight();
                $('.wrapper').css('margin-top', navbarHeight);
            });
        </script>
    @append
@endsection