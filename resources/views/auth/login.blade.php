@extends('layout.app')

@section('title', 'Experts')

@section('content')

    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Login Account</span></p>
                    <h1 class="mb-3 bread">Login</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-8 mb-5">


                    <form method="POST" class="search-job p-5 bg-white" action="{{ route('login') }}">
                        @csrf

                        {{-- ✉️ البريد الإلكتروني --}}
                        <div class="form-group mb-4">
                            <p class="label-fill">Email Address</p>
                            <div class="form-field">
                                <div class="icon"><span class="icon-envelope"></span></div>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control"
                                       placeholder="Enter your email"
                                       required
                                       autofocus
                                       autocomplete="username">
                            </div>
                            @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 🔐 كلمة المرور --}}
                        <div class="form-group mb-4">
                            <p class="label-fill">Password</p>
                            <div class="form-field position-relative">
                                <div class="icon"><span class="icon-lock"></span></div>

                                <input type="password"
                                       name="password"
                                       id="loginPassword"
                                       class="form-control pr-5"
                                       placeholder="Enter your password"
                                       required
                                       autocomplete="current-password">

                                <!-- زر العين -->
                                <button type="button" class="toggle-eye" data-target="loginPassword">
                                    <i class="icon-eye"></i>
                                </button>
                            </div>

                            @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- ✅ تذكرني --}}
                        <div class="form-group mb-4 d-flex align-items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="me-2">
                            <label for="remember_me" class="m-0">Remember me</label>
                        </div>

                        {{-- 📎 الرابط وزر الدخول --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted small">
                                    Forgot your password?
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                Log in
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    document.querySelectorAll('.toggle-eye').forEach(btn => {
        const targetId = btn.getAttribute('data-target');
        const input = document.getElementById(targetId);

        btn.addEventListener('mousedown', () => {
            input.type = 'text';
        });

        btn.addEventListener('mouseup', () => {
            input.type = 'password';
        });

        btn.addEventListener('mouseleave', () => {
            input.type = 'password';
        });
    });

</script>
