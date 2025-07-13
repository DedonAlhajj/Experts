@extends('layout.app')

@section('title', 'Specializations')

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Specializations</span></p>
                    <h1 class="mb-3 bread">Browse Specializations</h1>
                </div>
            </div>
        </div>
    </div>

    {{----------------------------------------------------------------------------------}}

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Expert's Specializations</span>
                    <h2 class="mb-0">Top Specializations</h2>
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

    <section style="padding-bottom: 65px !important;" class="ftco-section ftco-no-pb bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Browse specializations</span>
                    <h2 class="mb-4">Advance Search</h2>
                </div>
            </div>
            <div class="row">
                <div class="ftco-search">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Find a Candidate</a>

                            </div>
                        </div>
                        <div class="col-md-12 tab-wrap">

                            <div class="tab-content p-4" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                                    <form method="GET" action="{{ route('specializations') }}" class="search-job">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <div class="form-field">
                                                        <div class="icon"><span class="icon-user"></span></div>
                                                        <input type="text" name="title" class="form-control" placeholder="eg. Garphic. Web Developer">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-field border">
                                                        <button type="submit" class="form-control btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
