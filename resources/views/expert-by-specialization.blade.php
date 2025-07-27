@extends('layout.app')

@section('title', Setting::get('home.page_4.breadcrumb'))

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('{{asset('images/bg_1.jpg')}}');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">@setting('home.breadcrumb_1')
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>@setting('home.page_4.breadcrumb')</span></p>
                    <h1 class="mb-3 bread">{{$title}} - @setting('home.page_4.breadcrumb')</h1>
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
                        @foreach ($experts as $user)
                            <div class="col-md-12 ftco-animate">
                                <div class="team d-md-flex p-4 bg-white">

                                    @php
                                        $bgUrl = $user->hasMedia('profile_image')
                                            ? $user->getFirstMediaUrl('profile_image')
                                            : asset('images/default.jpg');
                                    @endphp

                                    <div class="img" style="background-image: url('{{ $bgUrl }}');"></div>

                                    <div class="text text1 pl-md-4">
                                        <span
                                            class="location mb-0">{{ $user->country ? $user->country .','. $user->city : 'undefined' }}</span>
                                        <h2>{{ $user->name }}</h2>
                                        <span class="position">{{ $user->is_expert_label  ?? 'User' }}</span>
                                        <span class="position">{{ $user->is_job_seeker_label  ?? 'User' }}</span>
                                        <p class="mb-2">{{ $user->bio ?? 'No description available.' }}</p>
                                        @php
                                            $website = $user->social_links['website'] ?? null;
                                        @endphp

                                        @if($website)
                                            <a href="{{ $website }}" target="_blank" class="seen" title="{{ $website }}">
                                                <i class="icon-link2"></i> Follow {{ $user->name }} on Their social profile
                                            </a>
                                        @else
                                            <span class="seen"><i class="icon-link2"></i> No social link available for {{ $user->name }}</span>
                                        @endif



                                        <p><a href="{{ route('profile.show', $user) }}"
                                              class="btn btn-outline-primary btn-sm"><i
                                                    class="fa fa-user"></i>Profile</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                @if ($experts->hasPages())
                                    <div class="pagination-custom">
                                        {{-- ← السابق --}}
                                        @if ($experts->onFirstPage())
                                            <span class="disabled">&larr;</span>
                                        @else
                                            <a href="{{ $experts->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}">&larr;</a>
                                        @endif

                                        {{-- التالي → --}}
                                        @if ($experts->hasMorePages())
                                            <a href="{{ $experts->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}">&rarr;</a>
                                        @else
                                            <span class="disabled">&rarr;</span>
                                        @endif
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 sidebar">
                    <form method="GET" action="{{url('/specialization') . '?title=' . urlencode($title) }}"
                          class="search-form mb-3">
                        <div class="sidebar-box bg-white p-4 ftco-animate">
                            <h3 class="heading-sidebar">Select Name</h3>
                            <input type="hidden" name="title" value="{{ $title }}">
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" name="name" value="{{$name}}" class="form-control"
                                       placeholder="Search...">
                            </div>


                        </div>

                        <div class="sidebar-box bg-white p-4 ftco-animate">
                            <h3 class="heading-sidebar">Select Location</h3>
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" name="location" value="{{$location}}" class="form-control"
                                       placeholder="Search...">
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

    @include('layout.subcribe')



@endsection
