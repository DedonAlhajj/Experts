@extends('layout.app')

@section('title', 'Profile')

@section('content')



    <div class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0">
                        <span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a>
                        </span>
                        <span>Profile</span></p>
                    <h1 class="mb-3 bread">Expert's Profile</h1>
                </div>
            </div>
        </div>
    </div>



    {{----------------------------------------------------------------------------------}}


    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        @if($user->gender === 'male')
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#007bff"
                                 class="bi bi-gender-male" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8"/>
                            </svg>
                        @elseif($user->gender === 'female')
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#e83e8c"
                                 class="bi bi-gender-female" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8M3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#6c757d"
                                 class="bi bi-gender-trans" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1.707L3.5 2.793l.646-.647a.5.5 0 1 1 .708.708l-.647.646.822.822A4 4 0 0 1 8 3c1.18 0 2.239.51 2.971 1.322L14.293 1H11.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 0 1-3.05-5.814l-.95-.949-.646.647a.5.5 0 1 1-.708-.708l.647-.646L1 1.707V3.5a.5.5 0 0 1-1 0zm5.49 4.856a3 3 0 1 0 5.02 3.288 3 3 0 0 0-5.02-3.288"/>
                            </svg>
                        @endif

                        <h2 class="mb-0" style=" margin-left: 10px;">{{ $user->name }}</h2>
                    </div>

                    <div
                        class="meta">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#adb5bd"
                             class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2"/>
                            <path
                                d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a13 13 0 0 1 1.313-.805h.632z"/>
                        </svg>
                        <span style="margin-left: 10px;
    top: 2px;
    position: relative;">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('F d, Y \a\t h:ia') }}</span>

                    </div>

                    <div style=" margin-top: 10px;">
                        <span class="info-user">{{ $user->is_expert_label  ?? 'User' }}</span>
                        <span class="info-user">{{ $user->is_job_seeker_label  ?? 'User' }}</span>
                        <span class="info-user">{{ $user->is_available_for_remote  ?? 'User' }}</span>
                        @if(Auth::user()->is_admin)
                            <span class="info-user">{{ $user->is_admin_text  ?? 'User' }}</span>
                            <span class="info-user">{{ $user->is_active_text  ?? 'User' }}</span>
                        @endif

                    </div>


                    <p>{{$user->bio}}.</p>


                    <h2 class="mb-3 mt-5 text-capitalize" style="color: #fdab44;"># Qualifications Summary</h2>


                    @foreach($expert_infos as $category => $items)
                        @if($items->isNotEmpty())



                            <div class="sidebar-box ftco-animate bg-light p-3 rounded">
                                <div class="categories">
                                    <h2 class="heading-3 text-capitalize">{{ ucfirst($category) }}s</h2>

                                    @foreach($items as $item)
                                        <li>
                                            <a href="#">
                                                {{ $item->title ?? 'بدون عنوان' }}
                                                {{-- إذا حابة تعرضي عدد أو تفاصيل إضافية حطيها هنا --}}
                                                {{-- <span>(12)</span> --}}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div> <!-- .col-md-8 -->
                <div class="col-md-4 pl-md-5 sidebar ftco-animate">

                    @auth

                        @if(Auth::user()->is_admin)
                            <div class="sidebar-box bg- p-4 ftco-animate bg-light rounded">
                                <form method="POST" action="{{ route('admin.users.toggleActivation', $user) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="{{ $user->is_active ? 'btn-profile-active' : 'btn-profile-inactive' }}">
                                        {{ $user->is_active ? 'Deactivate Account' : 'Activate Account' }}

                                    </button>
                                </form>
                            </div>
                        @endif

                    @endauth

                    <div class="sidebar-box">
                        @php
                            $bgUrl = $user->hasMedia('profile_image')
                                ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $user->getFirstMediaUrl('profile_image'))
                                : asset('images/default.jpg');
                        @endphp

                        <img src="{{$bgUrl}}" alt="Image placeholder" class="img-fluid mb-4">


                    </div>


                    <div class="sidebar-box">
                        <div class="p-4 mb-3 bg-light rounded">
                            <h3 class="h5 text-black mb-3">Contact Info</h3>
                            <p class="mb-0 font-weight-bold">Address</p>
                            @php
                                $parts = array_filter([
                                    $user->address,
                                    $user->city,
                                    $user->nationality,
                                    $user->country,
                                ]);
                            @endphp

                            <p class="mb-4">{{ implode(', ', $parts) }}</p>


                            <p class="mb-0 font-weight-bold">Phone</p>
                            <p class="mb-4"><a href="#">{{$user->phone}}</a></p>

                            <p class="mb-0 font-weight-bold">Email Address</p>
                            <p class="mb-0"><a href="#"><span class="__cf_email__"
                                                              data-cfemail="671e081215020a060e0b2703080a060e094904080a">{{$user->email}}</span></a>
                            </p>

                        </div>

                    </div>

                    @auth
                        @if (auth()->check() && auth()->user()->is($user))
                            <div class="sidebar-box bg- p-4 ftco-animate bg-light rounded">
                                <a href="{{ route('profile.edit') }}"
                                   style="background-color: #fdab44;
          width: 100%;
          height: 48px;
          color: aliceblue;
          display: flex;
          align-items: center;
          justify-content: center;
          font-weight: 600;
          text-decoration: none;
          border-radius: 8px;"
                                   class="btn">
                                    Edit Profile
                                </a>

                            </div>
                        @endif
                    @endauth


                        @php
                            $fileUrl = $user->hasMedia('cv_file')
                                ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $user->getFirstMediaUrl('cv_file'))
                                : null;
                        @endphp

                        @if($fileUrl)
                            <iframe src="{{ $fileUrl }}" width="100%" height="500px" style="border: none;"></iframe>
                        @else
                            <p>No CV file available</p>
                        @endif


                </div>

            </div>
        </div>
    </section> <!-- .section -->






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
