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
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Reset Password</span></p>
                    <h1 class="mb-3 bread">Reset Your Password</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-8 mb-5">


                        {{-- 📝 النموذج لإعادة تعيين كلمة المرور --}}
                        <form method="POST" class="search-job p-5 bg-white" action="{{ route('password.store') }}">
                            @csrf

                            {{-- 📍 التوكن السري لإعادة التعيين --}}
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            {{-- ✉️ البريد الإلكتروني --}}
                            <div class="form-group mb-4">
                                <p class="label-fill">Email Address</p>
                                <div class="form-field">
                                    <div class="icon"><span class="icon-envelope"></span></div>
                                    <input type="email"
                                           name="email"
                                           value="{{ old('email', $request->email) }}"
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

                            {{-- 🔑 كلمة المرور الجديدة --}}
                            <div class="form-group mb-4">
                                <p class="label-fill">New Password</p>
                                <div class="form-field">
                                    <div class="icon"><span class="icon-lock"></span></div>
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           placeholder="Enter new password"
                                           required
                                           autocomplete="new-password">
                                </div>
                                @error('password')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 🔁 تأكيد كلمة المرور --}}
                            <div class="form-group mb-4">
                                <p class="label-fill">Confirm Password</p>
                                <div class="form-field">
                                    <div class="icon"><span class="icon-check"></span></div>
                                    <input type="password"
                                           name="password_confirmation"
                                           class="form-control"
                                           placeholder="Confirm new password"
                                           required
                                           autocomplete="new-password">
                                </div>
                                @error('password_confirmation')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- ✅ زر الإرسال --}}
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </form>



                </div>
            </div>
        </div>
    </section>
@endsection
