<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Skillhunt</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{route('specializations')}}" class="nav-link">Specializations</a></li>
                <li class="nav-item"><a href="{{route('getJobSeeker.index')}}" class="nav-link">Job Seekers</a></li>
                <li class="nav-item"><a href="{{route('experts.index')}}" class="nav-link">Experts</a></li>
                <li class="nav-item"><a href="{{route('blog')}}" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>

                @guest
                    <li class="nav-item cta mr-md-1"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item cta cta-colored"><a href="{{ route('register') }}"
                                                                class="nav-link">Register</a></li>
                    @endif





                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="navbarDropdown">

                            <a href="{{ route('profile.show', auth()->user()) }}" class="dropdown-item">
                                Profile
                            </a>

{{--                            <a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a>--}}

                            @if (Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{route('admin.inactive-users') }}">Inactive Users</a>
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
