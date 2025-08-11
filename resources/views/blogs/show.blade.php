@extends('layout.app')

@section('title', 'blogs')

@section('content')
    <style>
        .localized-content {
            direction: rtl;
            text-align: justify;
            line-height: 1.8;
            word-break: break-word;
        }

        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }

        [dir="ltr"] {
            direction: ltr;
            text-align: left;
        }

    </style>
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

    <section class="ftco-section ftco-degree-bg bg-light">
        <div class="container">
            <div class="row">
                @php
                    $isArabic = \App\Helpers\TextHelper::isArabic(strip_tags($blog->title));
                    $direction = $isArabic ? 'rtl' : 'ltr';
                    $textAlign = $isArabic ? 'text-end' : 'text-start';
                @endphp

                <div class="col-md-8 ftco-animate localized-content" dir="{{ $direction }}">
                    <h2 class="mb-3 fw-bold {{ $textAlign }}">{{ $blog->title }}</h2>
                    <p class="text-muted {{ $textAlign }}">{{ $blog->summary }}</p>

                    @php
                        $bgUrl = $blog->hasMedia('blog_image')
                            ? $blog->getFirstMediaUrl('blog_image')
                            : asset('images/default.jpg');
                    @endphp

                    <p>
                        <img src="{{ $bgUrl }}" alt="" class="img-fluid rounded mb-3">
                    </p>

                    <p class="{{ $textAlign }}">{{ $blog->content }}</p>
                </div>






                <div class="col-md-4 pl-md-5 sidebar ftco-animate">

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading-3" style="background-color: #f2f2f3;
    padding: 3px;
    text-align: center;
    border-radius: 4px;">Recent Blog</h3>
                        @if($latestBlogs->count())
                        @foreach($latestBlogs as $item)
                            @php
                                $bgUrlitem = $item->hasMedia('blog_image')
                                    ? $item->getFirstMediaUrl('blog_image')
                                    : asset('images/default.jpg');
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
                        @else
                            <div class="sidebar-box ftco-animate text-center py-5">
                                {{-- <img src="{{ asset('images/no-posts.svg') }}" alt="No posts" class="img-fluid mb-4" style="max-width: 180px;"> --}}
                                <i class="icon-folder-open display-4 text-warning mb-3"></i>
                                <h5 class="text-muted mb-2">No blog posts available at the moment</h5>
                                <p class="text-secondary">Stay tuned for fresh and exciting content coming soon.</p>
                                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary mt-3">
                                    <i class="icon-arrow-left"></i> Back to Home
                                </a>
                            </div>

                        @endif
                    </div>

                </div>

            </div>
        </div>
    </section>


@endsection
