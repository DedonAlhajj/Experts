@extends('layout.app')

@section('title', Setting::get('home.breadcrumb_1'))

@section('content')

    <style>
        /*.swiper-slide img {*/
        /*    animation: breathe 5s ease-in-out infinite;*/
        /*}*/

        /*@keyframes breathe {*/
        /*    0%, 100% { transform: scale(1); opacity: 1; }*/
        /*    50%      { transform: scale(1.02); opacity: 0.95; }*/
        /*}*/
        .swiper-slide {
            display: flex;
            justify-content: center;
            /*align-items: center;*/
            height: 500px; /* أو نفس ارتفاع السلايدر */
        }

        @media (max-width: 991.98px) {
            .ad-left-swiper,
            .ad-right-swiper {
                display: none !important;
            }
        }


        /* إخفاء الشرائح غير النشطة ومنع أثرها */
        .ad-left-swiper .swiper-slide,
        .ad-right-swiper .swiper-slide {
            position: relative;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.6s ease-in-out, visibility 0.6s ease-in-out;
        }

        .ad-left-swiper .swiper-slide.swiper-slide-active,
        .ad-right-swiper .swiper-slide.swiper-slide-active {
            opacity: 1;
            visibility: visible;
        }


        /* تثبيت ارتفاع الصور داخل الشرائح */
        .ad-left-swiper .swiper-slide img,
        .ad-right-swiper .swiper-slide img {
            max-height: 400px;
            object-fit: cover;
            width: auto;
            height: auto;
        }

        .ad-sidebar-swiper .swiper-wrapper {
            display: flex;
            flex-direction: column;
        }

        .ad-sidebar-swiper .swiper-slide {
            display: block;
            padding-top: 0;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                max-width: 100%;
                width: 100%;
                padding-left: 15px;
                padding-right: 15px;
            }

            .ad-sidebar-swiper {
                max-height: unset;
            }

            .sidebar .swiper-slide img {
                height: auto;
                max-height: 300px; /* أو حسب ما يناسب المحتوى */
            }

            .sidebar .sidebar-box {
                padding: 0;
                margin-bottom: 20px;
            }

            .sidebar .swiper-slide {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                height: auto !important;
                min-height: unset !important;
                max-height: unset;
                padding: 0 10px;
            }

        }


    </style>
    @include('layout.home_nav')

    <section class="ftco-section overflow-hidden">

        <div class="container-fluid px-0">
            <div class="row gx-0"> {{-- ✅ gx-0 لمنع الهوامش بين الأعمدة --}}
                <div class="col-lg-2 d-none d-lg-flex  justify-content-center">
                    <div class="swiper ad-left-swiper"
                         style="height: 500px;   padding-left: 30px; padding-top: 44px; overflow: hidden;">
                        <div class="swiper-wrapper">
                            @foreach($ads['sidebarLeft'] ?? [] as $ad)
                                <div class="swiper-slide mb-3">
                                    <a href="{{ route('ads.redirect', $ad) }}" target="_blank">
                                        <img src="{{ $ad->getFirstMediaUrl('ad') ?? asset('images/default.jpg') }}"
                                             style="max-height: 400px; object-fit: cover;"
                                             class="img-fluid w-100"
                                             alt="{{ $ad->title }}">

                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="row justify-content-center mb-5">
                        <div class="col-md-7 heading-section text-center ftco-animate">
                            <span class="subheading">@setting('home.section_2.title_1')</span>
                            <h2 class="mb-0">@setting('home.section_2.title_2')</h2>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        @foreach($specializations as $item)
                            <div class="col-12 col-sm-6 col-md-3 mb-3">
                                <ul class="category text-center">
                                    <li>
                                        <a href="{{ route('experts.bySpecialization', ['title' => $item->title]) }}">
                                            {{ Str::title($item->title) }} <br>
                                            <span class="number">{{ $item->total }}</span>
                                            <span>Open position</span>
                                            <i class="ion-ios-arrow-forward"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="col-lg-2 d-none d-lg-flex  justify-content-center">
                    <div class="swiper ad-right-swiper"
                         style="height: 500px;  padding-right: 30px;   padding-top: 44px; overflow: hidden;">

                        <div class="swiper-wrapper">
                            @foreach($ads['sidebarRight'] ?? [] as $ad)
                                <div class="swiper-slide mb-3">
                                    <a href="{{ route('ads.redirect', $ad) }}" target="_blank">
                                        <img src="{{ $ad->getFirstMediaUrl('ad') ?? asset('images/default.jpg') }}"
                                             style="max-height: 400px; object-fit: cover;"
                                             class="img-fluid w-100"
                                             alt="{{ $ad->title }}">

                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="py-1 bg-light d-block d-lg-none" style="margin-bottom: 0;">
        <div class="container">
            <div class="swiper ad-mobile-swiper">
                <div class="swiper-wrapper">
                    @foreach($ads['sidebarLeft'] ?? [] as $ad)
                        <div class="swiper-slide text-center" style=" display: flex;
    justify-content: center;
    align-items: center;
    height: auto !important;">
                            <a href="{{ route('ads.redirect', $ad) }}" target="_blank">
                                <img src="{{ $ad->getFirstMediaUrl('ad') ?? asset('images/default.jpg') }}"
                                     class="img-fluid rounded mx-auto d-block mb-2"
                                     style="height: auto; max-width: 70%;"
                                     alt="{{ $ad->title }}">

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-resume"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">@setting('home.section_3.block_1.title')</h3>
                            <p>@setting('home.section_3.block_1.text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-team"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">@setting('home.section_3.block_2.title')</h3>
                            <p>@setting('home.section_3.block_2.text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-career"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">@setting('home.section_3.block_3.title')</h3>
                            <p>@setting('home.section_3.block_3.text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-employees"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">@setting('home.section_3.block_4.title')</h3>
                            <p>@setting('home.section_3.block_4.text')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 pr-lg-5">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading">@setting('home.section_4.heading_1')</span>
                            <h2 class="mb-4">@setting('home.section_4.heading_2')</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($users as $user)
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
                                            <a href="{{ $website }}" target="_blank" class="seen"
                                               title="{{ $website }}">
                                                <i class="icon-link2"></i> Follow {{ $user->name }} on Their social
                                                profile
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
                </div>
                <div class="col-lg-3 sidebar">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <h2 class="mb-4">@setting('home.section_4.heading_3')</h2>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate" style=" display: flex;
    flex-direction: column;
    align-items: center;">
                        <div class="swiper ad-sidebar-swiper" style="overflow: hidden;">
                            <div class="swiper-wrapper">
                                @if(isset($ads['sidebarRight']))
                                    @foreach ($ads['sidebarRight'] as $ad)
                                        @php
                                            $img = $ad->hasMedia('ad')
                                                ? $ad->getFirstMediaUrl('ad')
                                                : asset('images/default.jpg');
                                        @endphp

                                        <div class="swiper-slide text-center">
                                            <a href="{{ route('ads.redirect', $ad) }}" target="_blank" class="d-block">
                                                <img src="{{ $img }}"
                                                     class="img-fluid rounded mx-auto d-block mb-2"
                                                     style="max-width: 100%; height: auto;"
                                                     alt="{{ $ad->title }}">

                                                <h6 class="fw-bold text-dark">{{ Str::limit($ad->title, 50) }}</h6>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </section>


    @if(isset($ads['inline']) && count($ads['inline']))
        <div class="ad-banner-area" style="padding-bottom: 33px;
    background-color: #f8f9fa;">
            <div class="container">
                <div class="swiper ad-banner-swiper" style="height: 96px;">
                    <div class="swiper-wrapper">
                        @foreach($ads['inline'] as $ad)
                            @php
                                $img = $ad->hasMedia('ad')
                                    ? $ad->getFirstMediaUrl('ad')
                                    : asset('images/default.jpg');
                            @endphp
                            <div class="swiper-slide">
                                <a href="{{ route('ads.redirect', $ad) }}" target="_blank" class="d-block w-100 h-100">
                                    <img src="{{ $img }}"
                                         class="img-fluid"
                                         style="height: 96px; object-fit: cover; width: 100%; display: block;"
                                         alt="{{ $ad->title }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif



    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-4">@setting('home.section_5.title')</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">

                        @foreach ($experts as $expert)
                            @php
                                $bgUrlExpert = $expert->hasMedia('profile_image')
                                    ?  $expert->getFirstMediaUrl('profile_image')
                                    : asset('images/default.jpg');
                            @endphp
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="text">
                                        <p class="mb-4" style="min-height: 86px;
    max-height: 86px;
    overflow: hidden;">{{ \Illuminate\Support\Str::limit($expert->bio, 100, '...') }}</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img"
                                                 style="background-image: url('{{$bgUrlExpert}}')"></div>
                                            <div class="pl-3">
                                                <p class="name">{{$expert->name}}</p>
                                                <span class="position">
                                                <a href="{{ route('profile.show', $expert) }}"
                                                   class="">
                                                    <i class="fa fa-user"></i>
                                                    Show Profile</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-candidates bg-primary">
        <div class="container">
            <div class="row justify-content-center pb-3">
                <div class="col-md-10 heading-section heading-section-white text-center ftco-animate">
                    <span class="subheading">@setting('home.section_6.label')</span>
                    <h2 class="mb-4">@setting('home.section_6.description')</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-candidates owl-carousel">

                        @foreach ($users as $user)
                            <div class="item">
                                <a href="{{ route('profile.show', $user) }}" class="team text-center">
                                    @php
                                        $bgUrl = $user->hasMedia('profile_image')
                                            ? $user->getFirstMediaUrl('profile_image')
                                            : asset('images/default.jpg');
                                    @endphp

                                    <div class="img" style="background-image: url('{{ $bgUrl }}');"></div>
                                    <h2>{{ $user->name }}</h2>
                                    <span
                                        class="position">{{ $user->country ? $user->country .','. $user->country : 'undefined' }}</span>
                                </a>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">@setting('home.section_7.title')</span>
                    <h2><span>@setting('home.section_7.description')</span></h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($jobSeekers as $jobSeeker)
                    @php
                        $bgUrlJobSeeker = $jobSeeker->hasMedia('profile_image')
                            ? $jobSeeker->getFirstMediaUrl('profile_image')
                            : asset('images/default.jpg');
                    @endphp
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch w-100">
                            <a href="" class="block-20"
                               style="background-image: url('{{$bgUrlJobSeeker}}');">
                            </a>
                            <div class="text mt-3">
                                <div class="meta d-flex justify-content-between align-items-center mb-2">
                                    <div class="location-text text-truncate flex-grow-1">
                                        <a href="{{ route('profile.show', $jobSeeker) }}" style="color: #fcbe73;">
                                            {{$jobSeeker->name}} </a>
                                    </div>
                                    <div class="location-icon ms-2 flex-shrink-0">
                                        <a href="{{ route('profile.show', $jobSeeker) }}" class="meta-chat"
                                           style="color: #fdab44;">
                                            <span class="icon-user"></span>
                                        </a>
                                    </div>
                                </div>

                                <span
                                    class="position">{{ \Illuminate\Support\Str::limit($jobSeeker->country .', '. $jobSeeker->city, 60, '...') }}</span>


                                <h3 class="heading"><a
                                        href="{{ route('profile.show', $jobSeeker) }}">{{ \Illuminate\Support\Str::limit($jobSeeker->bio, 70, '...') }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('layout.subcribe')

@endsection
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const adDelay = {{ Setting::get('ads_rotation_delay', 5000) }}; // أو استبدليه بـ رقم ثابت مثلاً 4000
        new Swiper('.ad-mobile-swiper', {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: adDelay,
                disableOnInteraction: false
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 700,
            allowTouchMove: true
        });
    });
</script>


<script>
    const adDelay = {{ Setting::get('ads_rotation_delay', 5000) }};

    document.addEventListener('DOMContentLoaded', function () {
        // ✅ تفعيل السلايدر الجانبي
        new Swiper('.ad-sidebar-swiper', {
            direction: 'vertical',
            slidesPerView: 1,
            loop: true,
            effect: 'fade',
            fadeEffect: {crossFade: true},
            autoplay: {
                delay: {{ Setting::get('ads_rotation_delay', 5000) }},
                disableOnInteraction: false
            },
            speed: 800,
            allowTouchMove: false,
            autoHeight: true, // ✅ هذا هو المفتاح
            observer: true,
            observeParents: true
        });


        // ✅ تفعيل السلايدر الأفقي (البانر)
        new Swiper('.ad-banner-swiper', {
            slidesPerView: 1,
            loop: true,
            effect: 'fade',
            fadeEffect: {crossFade: true},
            autoplay: {
                delay: adDelay,
                disableOnInteraction: false
            },
            speed: 1000,
            allowTouchMove: false
        });
    });

    document.addEventListener('DOMContentLoaded', function () {


        new Swiper('.ad-left-swiper', {
            direction: 'vertical',
            slidesPerView: 1,
            loop: true,
            effect: 'fade',
            fadeEffect: {crossFade: true},
            autoplay: {
                delay: {{ Setting::get('ads_rotation_delay', 5000) }},
                disableOnInteraction: false
            },
            speed: 600,
            allowTouchMove: false,
            autoHeight: false, // ✅ يمنع تمدد الـ swiper حسب محتوى الشرائح
            observer: true,
            observeParents: true
        });

        new Swiper('.ad-right-swiper', {
            direction: 'vertical',
            slidesPerView: 1,
            loop: true,
            effect: 'fade',
            fadeEffect: {crossFade: true},
            autoplay: {
                delay: {{ Setting::get('ads_rotation_delay', 5000) }},
                disableOnInteraction: false
            },
            speed: 800,
            allowTouchMove: false,
            autoHeight: false,
            observer: true,
            observeParents: true
        });

    });
</script>
