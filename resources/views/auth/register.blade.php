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
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Register Account</span></p>
                    <h1 class="mb-3 bread">Register</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-8 mb-5">

                    <form method="POST" class="search-job p-5 bg-white" action="{{ route('register') }}">
                        @csrf

                        {{-- 👤 الاسم الكامل --}}
                        <div class="form-group mb-4">
                            <p class="label-fill">Full Name</p>
                            <div class="form-field">
                                <div class="icon"><span class="icon-user"></span></div>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-control"
                                       placeholder="Enter your full name"
                                       required
                                       autocomplete="name"
                                       autofocus>
                            </div>
                            @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

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
                                       autocomplete="username">
                            </div>
                            @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- كلمة المرور -->
                        <div class="form-group mb-4">
                            <p class="label-fill">Password</p>
                            <div class="form-field position-relative">
                                <div class="icon"><span class="icon-lock"></span></div>

                                <input type="password"
                                       name="password"
                                       id="newPassword"
                                       class="form-control pr-5"
                                       placeholder="Enter password"
                                       required
                                       autocomplete="new-password">

                                <button type="button" class="toggle-eye" data-target="newPassword">
                                    <i class="icon-eye"></i>
                                </button>
                            </div>
                            @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="form-group mb-4">
                            <p class="label-fill">Confirm Password</p>
                            <div class="form-field position-relative">
                                <div class="icon"><span class="icon-check"></span></div>

                                <input type="password"
                                       name="password_confirmation"
                                       id="confirmPassword"
                                       class="form-control pr-5"
                                       placeholder="Confirm password"
                                       required
                                       autocomplete="new-password">

                                <button type="button" class="toggle-eye" data-target="confirmPassword">
                                    <i class="icon-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- 🧭 زر الدخول والرابط --}}
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('login') }}" class="text-muted small">
                                Already registered?
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </section>
@endsection
