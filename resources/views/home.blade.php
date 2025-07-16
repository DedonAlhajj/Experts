@extends('layout.app')

@section('title', 'Home')

@section('content')
    @include('layout.home_nav')


    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Expert's specializations</span>
                    <h2 class="mb-0">Top specializations</h2>
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
    </section>
    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-resume"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Browse a Lot of Expert Profiles</h3>
                            <p>Explore a rapidly growing network of professionals across
                                diverse fields—whether they're seeking job opportunities,
                                showcasing their expertise, or doing both.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-team"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Flexible Talent Connections</h3>
                            <p>Discover top talent effortlessly,
                                follow their latest updates, and connect over
                                opportunities or services that align with your career goals or project needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-career"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Leading Career Tracks</h3>
                            <p>Dive into the most in-demand specialties and explore
                                the expertise of leaders in tech, design, business, and beyond.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services d-block">
                        <div class="icon"><span class="flaticon-employees"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Find Top-Tier Professionals</h3>
                            <p>Easily locate experts with
                                the right skills and proven experience using an intelligent,
                                lightning-fast search system.</p>
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
                            <span class="subheading">Recently Added Experts</span>
                            <h2 class="mb-4">Newest Members to Join the Platform</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($users as $user)
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
                                        <span class="seen">Last Activity 4 months ago</span>
                                        <p><a href="{{ route('profile.show', $user) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-user"></i>Profile</a></p>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-3 sidebar">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <h2 class="mb-4">Top Recruitments</h2>
                        </div>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <div class="lolo">
                            <a href="#" class="company-wrap"><img src="images/company-1.jpg" class="img-fluid"
                                                                  alt="Colorlib Free Template"></a>
                            <div class="text p-3">
                                <h3><a href="#">Company Company</a></h3>
                                <p><span class="number">500</span> <span>Open position</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <div class="">
                            <a href="#" class="company-wrap"><img src="images/company-2.jpg" class="img-fluid"
                                                                  alt="Colorlib Free Template"></a>
                            <div class="text p-3">
                                <h3><a href="#">Facebook Company</a></h3>
                                <p><span class="number">700</span> <span>Open position</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <div class="">
                            <a href="#" class="company-wrap"><img src="images/company-3.jpg" class="img-fluid"
                                                                  alt="Colorlib Free Template"></a>
                            <div class="text p-3">
                                <h3><a href="#">IT Programming INC</a></h3>
                                <p><span class="number">700</span> <span>Open position</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <div class="">
                            <a href="#" class="company-wrap"><img src="images/company-4.jpg" class="img-fluid"
                                                                  alt="Colorlib Free Template"></a>
                            <div class="text p-3">
                                <h3><a href="#">IT Programming INC</a></h3>
                                <p><span class="number">700</span> <span>Open position</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-4">Featured Experts You May Want to Connect With</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">

                        @foreach ($experts as $expert)
                            @php
                                $bgUrlExpert = $expert->hasMedia('profile_image')
                                    ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $expert->getFirstMediaUrl('profile_image'))
                                    : asset('images/default.jpg');
                            @endphp
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="text">
                                        <p class="mb-4" style="min-height: 86px;
    max-height: 86px;
    overflow: hidden;">{{ \Illuminate\Support\Str::limit($expert->bio, 100, '...') }}</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img" style="background-image: url('{{$bgUrlExpert}}')"></div>
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
                    <span class="subheading">Experts</span>
                    <h2 class="mb-4">Recently Registered Experts with Valuable Experience</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-candidates owl-carousel">

                        @foreach ($users as $user)
                            <div class="item">
                                <a href="#" class="team text-center">
                                    @php
                                        $bgUrl = $user->hasMedia('profile_image')
                                            ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $user->getFirstMediaUrl('profile_image'))
                                            : asset('images/default.jpg');
                                    @endphp

                                    <div class="img" style="background-image: url('{{ $bgUrl }}');"></div>
                                    <h2>{{ $user->name }}</h2>
                                    <span class="position">{{ $user->country ? $user->country .','. $user->country : 'undefined' }}</span>
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
                    <span class="subheading">Our Job Seekers</span>
                    <h2><span>Talented Job Seekers</span> Ready for New Opportunities</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($jobSeekers as $jobSeeker)
                    @php
                        $bgUrlJobSeeker = $jobSeeker->hasMedia('profile_image')
                            ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $jobSeeker->getFirstMediaUrl('profile_image'))
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
                                        <a href="{{ route('profile.show', $jobSeeker) }}" class="meta-chat" style="color: #fdab44;">
                                            <span class="icon-user"></span>
                                        </a>
                                    </div>
                                </div>

                                <span class="position">{{ \Illuminate\Support\Str::limit($jobSeeker->country .', '. $jobSeeker->city, 60, '...') }}</span>


                                <h3 class="heading"><a href="{{ route('profile.show', $jobSeeker) }}">{{ \Illuminate\Support\Str::limit($jobSeeker->bio, 70, '...') }}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                        <h2>Subcribe to our Newsletter</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in</p>
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
