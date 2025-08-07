@extends('layout.app')

@section('title', Setting::get('home.page_2.breadcrumb_2'))

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">@setting('home.breadcrumb_1')
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>@setting('home.page_2.breadcrumb_2')</span></p>
                    <h1 class="mb-3 bread">@setting('home.page_2.header_text_1')</h1>
                </div>
            </div>
        </div>
    </div>

    {{----------------------------------------------------------------------------------}}

    <section style="padding-bottom: 65px !important;" class="ftco-section ftco-no-pb bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7 text-center heading-section ftco-animate">
{{--                    <span class="subheading">@setting('home.page_2.subsection_1.text_1')</span>--}}
                    <h2 class="mb-4">@setting('home.page_2.subsection_1.text_1')</h2>
                </div>
            </div>
            <div class="row">
                <div class="ftco-search">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">@setting('form_title2')</a>

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
                                                        <input type="text" name="title" value="{{$title}}" class="form-control" placeholder="eg. Garphic. Web Developer">
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

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
{{--                    <span class="subheading">Expert's Specializations</span>--}}
                    <h2 class="mb-0">Top Specializations</h2>
                </div>
            </div>
            <div class="d-flex flex-wrap">
                @if($specializations && count($specializations))
                @foreach($specializations as $item)
                    <div class="col-12 col-sm-6 col-md-3 mb-3">
                        <ul class="category text-center">
                            <li>
                                <a href="{{ url('/specialization') . '?title=' . urlencode($item->title) }}">

                                {{ Str::title($item->title) }} <br>
                                    <span class="number">{{ $item->total }}</span>
                                    <span>Open position</span>
                                    <i class="ion-ios-arrow-forward"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach
                @else
                    <div class="text-center text-muted">There are no specializations currently.</div>
                @endif
            </div>
        </div>
    </section>



    @include('layout.subcribe')



@endsection
