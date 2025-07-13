@extends('layout.app')

@section('title', 'Forgot Password')

@section('content')

    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Forgot Password</span></p>
                    <h1 class="mb-3 bread">Forgot your password?</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-8 mb-5">
                    {{-- 💡 وصف تعريفي --}}
                    <div class="text-muted mb-4 ">
                        Forgot your password? No problem. Just enter your email address and we’ll send you a link to
                        reset it.
                    </div>

                    {{-- ✅ رسالة الحالة (اختياري) --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- 🔐 النموذج --}}
                    <form method="POST" class="search-job p-5 bg-white" action="{{ route('password.email') }}">
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
                                       autofocus>
                            </div>
                            @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 📨 زر الإرسال --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection


