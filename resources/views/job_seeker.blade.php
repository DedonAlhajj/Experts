@extends('layout.app')

@section('title',Setting::get('home.page_3.breadcrumb'))

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">@setting('home.breadcrumb_1')
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>@setting('home.page_3.breadcrumb')</span></p>
                    <h1 class="mb-3 bread">@setting('home.page_3.header_text')</h1>
                </div>
            </div>
        </div>
    </div>

    {{----------------------------------------------------------------------------------}}


    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="row">
                        @foreach ($getJobSeeker as $user)
                            <div class="col-md-12 ftco-animate">
                                <div class="team d-md-flex p-4 bg-white">
                                    @php
                                        $bgUrl = $user->hasMedia('profile_image')
                                            ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $user->getFirstMediaUrl('profile_image'))
                                            : asset('images/default.jpg');
                                    @endphp

                                    <div class="img" style="background-image: url('{{ $bgUrl }}');"></div>
                                    <div class="text text1 pl-md-4">
                                        <span class="location mb-0">{{ $user->country ? $user->country .','. $user->city : 'undefined' }}</span>
                                        <h2>{{ $user->name }}</h2>
                                        <span class="position">{{ $user->is_expert_label  ?? 'User' }}</span>
                                        <span class="position">{{ $user->is_job_seeker_label  ?? 'User' }}</span>
                                        <p class="mb-2">{{ $user->bio ?? 'No description available.' }}</p>
                                        <span class="seen">{{$user->is_available_for_remote}}</span>
                                        <p><a href="{{ route('profile.show', $user) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-user"></i>Profile</a></p>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                @include('layout.pagination', ['paginator' => $getJobSeeker])
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 sidebar">
                    <form method="GET" action="{{ route('getJobSeeker.index') }}" class="search-form mb-3">
                        <div class="sidebar-box bg-white p-4 ftco-animate">
                            <h3 class="heading-sidebar">Browse specializations</h3>

                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" name="title" value="{{$title}}" class="form-control" placeholder="Search...">
                            </div>


                        </div>

                        <div class="sidebar-box bg-white p-4 ftco-animate">
                            <h3 class="heading-sidebar">Select Location</h3>
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text"  name="location" value="{{$location}}" class="form-control" placeholder="Search...">
                            </div>

                        </div>

                        <div class="sidebar-box bg-white p-4 ftco-animate">
                            <div class="form-field border">
                                <button type="submit" class="form-control btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                        <h2>Subcribe to our Newsletter</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
                        <div class="row d-flex justify-content-center mt-4 mb-4">
                            <div class="col-md-12">
                                <form action="#" class="subscribe-form">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Enter email address">
                                        <input type="submit" value="Subscribe" class="submit px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
