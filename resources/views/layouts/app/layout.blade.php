@extends('layouts.main')

@section('content')
    @include('layouts.app.navbar')
    <div class="wrapper">
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