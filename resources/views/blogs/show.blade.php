@extends('layout.app')

@section('title', 'blogs')

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-3"><a href="blog.html">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog Single</span></p>
                    <h1 class="mb-3 bread">Single Blog
                        @if (auth()->check() && Auth::user()->is_admin)
                            <a href="{{ route('blogs.edit', $blog)}}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="icon-edit"></i>
                            </a>
                        @endif
                        </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">
                    <h2 class="mb-3">{{$blog->title}}</h2>
                    <p>{{$blog->summary}}</p>
                    @php
                        $bgUrl = $blog->hasMedia('blog_image')
                            ? $blog->getFirstMediaUrl('blog_image')
                            : asset('images/image_1.jpg');
                    @endphp
                    <p>
                        <img src="{{$bgUrl}}" alt="" class="img-fluid">
                    </p>

                    <p>{{$blog->content}}</p>

{{--                    <div class="about-author d-flex p-4 bg-light">--}}
{{--                        <div class="bio mr-5">--}}
{{--                            <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">--}}
{{--                        </div>--}}
{{--                        <div class="desc">--}}
{{--                            <h3>George Washington</h3>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}



                </div> <!-- .col-md-8 -->
                <div class="col-md-4 pl-md-5 sidebar ftco-animate">

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading-3">Recent Blog</h3>
                        @foreach($latestBlogs as $item)
                            @php
                                $bgUrlitem = $item->hasMedia('blog_image')
                                    ? $item->getFirstMediaUrl('blog_image')
                                    : asset('images/image_1.jpg');
                            @endphp
                            <p>
                            <div class="block-21 mb-4 d-flex">
                                <a href="{{ route('blogs.show', $item) }}" class="blog-img mr-4"
                                   style="background-image: url('{{$bgUrlitem }}');">
                                </a>
                                <div class="text">
                                    <h3 class="heading">
                                        <a href="{{ route('blogs.show', $item) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="meta">
                                        <div>
                                            <a href="#">
                                                <span class="icon-calendar"></span>
                                                {{ $item->published_at?->format('F j, Y') ?? $item->created_at->format('F j, Y') }}
                                            </a>
                                        </div>
                                        <div>
                                            <a href="#">
                                                <span class="icon-person"></span>
                                                {{ $item->author->name ?? 'Admin' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </section> <!-- .section -->


@endsection
