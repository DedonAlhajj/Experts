@extends('layout.app')

@section('title', 'blogs')

@section('content')
    <style>
        .blog-column {
            flex: 0 0 25%;
            max-width: 25%;
            padding: 15px;
            box-sizing: border-box;
        }

        @media (max-width: 767.98px) {
            .blog-column {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .blog-entry {
            width: 100%;
            background: transparent;
            border-radius: 6px;
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);*/
            padding-bottom: 10px;
            overflow-wrap: break-word;
            word-break: break-word;
        }


        .block-20 {
            display: block;
            width: 100%;
            padding-top: 75%;
            background-size: cover;
            background-position: center;
            border-radius: 6px;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .icons-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .date-wrapper {
            margin-left: auto;
            white-space: nowrap;
            text-align: right;
        }

        .btn-delete {
            background: transparent;
            border: none;
            color: #dc3545;
            padding-left: 0;
            padding-bottom: 5px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .icon-edit,
        .icon-trash {
            font-size: 1.2rem;
            vertical-align: middle;
        }


    </style>
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Blog</span></p>
                    <h1 class="mb-3 bread">Our Blog
                        @if (auth()->check() && Auth::user()->is_admin)
                        <a href="{{ route('blogs.create') }}"
                                                      class="btn btn-sm btn-outline-warning" title="Create">
                            <i class="icon-add"></i>
                        </a>
                        @endif
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light" >
        <div class="container">
            <div class="row d-flex">
                @if($blogs->count())
                    @foreach($blogs as $blog)
                        @php
                            $bgUrl = $blog->hasMedia('blog_image')
                                ? $blog->getFirstMediaUrl('blog_image')
                                : asset('images/default.jpg');
                        @endphp

                        <div class="col-md-3 blog-column">
                            <div class="blog-entry">
                                <a href="{{ route('blogs.show', $blog->id) }}" class="block-20"
                                   style="background-image: url('{{ $bgUrl }}');">
                                </a>
                                <div class="text mt-3">
                                    <div class="meta mb-2 d-flex align-items-center">
                                        <div class="d-flex gap-3 align-items-center icons-wrapper">
                                            <!-- Edit -->
                                            <a href="{{ route('blogs.edit', $blog) }}" class="text-primary" title="Edit">
                                                <i class="icon-edit"></i>
                                            </a>
                                            <!-- Delete -->
                                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')" class="m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Delete">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="date-wrapper">
                                            <small class="text-muted">{{ $blog->published_at?->format('F j, Y') ?? '—' }}</small>
                                        </div>
                                    </div>

                                    @php
                                        $isArabic = \App\Helpers\TextHelper::isArabic(strip_tags($blog->title));
                                        $direction = $isArabic ? 'rtl' : 'ltr';
                                        $textAlign = $isArabic ? 'text-end' : 'text-start';
                                    @endphp


                                    <h3 class="heading" style="text-align: {{ $textAlign === 'text-end' ? 'right' : 'left' }};" dir="{{ $direction }}">

                                    <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                    </h3>

                                    <div class="meta mb-2 d-flex justify-content-between align-items-center" dir="{{ $direction }}">
                                        <div class="status-indicator {{ $textAlign }}">
        <span class="badge px-3 py-2 fw-bold rounded-pill
            {{ $blog->is_published ? 'bg-success text-white' : 'bg-warning text-dark' }}">
            {{ $blog->is_published ? '✓ Published' : '× Unpublished' }}
        </span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center py-5">
                        <h5 class="text-muted">No blog posts available yet.</h5>
                        <p class="mb-0">Start creating content that reflects your platform’s value ✨</p>
                    </div>
                @endif


            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        @include('layout.pagination', ['paginator' => $blogs])
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
