@extends('layout.app')

@section('title', 'Home')

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





@endsection
