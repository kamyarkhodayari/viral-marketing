<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @auth
                    @can('index', App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('panel_users') }}" class="nav-link @if(Route::currentRouteName() == 'panel_users') active @endif">Users</a>
                        </li>
                    @endcan

                    @can('index', App\Models\Product::class)
                        <li class="nav-item">
                            <a href="{{ route('panel_products') }}" class="nav-link @if(Route::currentRouteName() == 'panel_products') active @endif">Products</a>
                        </li>
                    @endcan

                    @can('index', App\Models\Share::class)
                        <li class="nav-item">
                            <a href="{{ route('panel_shares') }}" class="nav-link @if(Route::currentRouteName() == 'panel_shares') active @endif">Shares</a>
                        </li>
                    @endcan

                    @can('index', App\Models\Purchase::class)
                        <li class="nav-item">
                            <a href="{{ route('panel_purchases') }}" class="nav-link @if(Route::currentRouteName() == 'panel_purchases') active @endif">Purchases</a>
                        </li>
                    @endcan
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>