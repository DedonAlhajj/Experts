<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('storage/' . Setting::get('logo')) }}"
                 onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';"
                 alt="Watantech" height="50">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">@setting('home.nav.item_1')</a></li>
                <li class="nav-item"><a href="{{route('specializations')}}" class="nav-link">@setting('home.nav.item_2')</a></li>
                <li class="nav-item"><a href="{{route('getJobSeeker.index')}}" class="nav-link">@setting('home.nav.item_3')</a></li>
                <li class="nav-item"><a href="{{route('experts.index')}}" class="nav-link">@setting('home.nav.item_4')</a></li>
                <li class="nav-item"><a href="{{route('blogs.index')}}" class="nav-link">@setting('home.nav.item_5')</a></li>
{{--                <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>--}}

                @guest
                    <li class="nav-item cta mr-md-1"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item cta cta-colored"><a href="{{ route('register') }}"
                                                                class="nav-link">Register</a></li>
                    @endif





                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show', auth()->user()) }}">
                                Profile
                            </a>

                            @if (Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{route('admin.inactive-users')}}">Inactive Users</a>
                                <a class="dropdown-item" href="{{route('blogs.index')}}">Blogs</a>
                                <a class="dropdown-item" href="{{route('cache.forget')}}">Cache Forget</a>
                                <a class="dropdown-item" href="{{route('ads.index')}}">Ads</a>
                                <a class="dropdown-item" href="{{route('settings.index')}}">Settings</a>
                                <a class="dropdown-item" href="{{route('newsletter.index')}}">Subscribers</a>
                                <a class="dropdown-item" href="{{route('newsletters.index')}}">Newsletters</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </div>
                    </li>
                @endauth



            </ul>
        </div>
    </div>
</nav>

@if(session('success') || session('error'))
    <div id="flash-message" class="flash-message {{ session('success') ? 'success' : 'error' }}">
        {{ session('success') ?? session('error') }}
    </div>
@endif

@if(session('errors'))
    <div id="flash-message" class="flash-message error">
        {{ session('errors')}}
    </div>
@endif
