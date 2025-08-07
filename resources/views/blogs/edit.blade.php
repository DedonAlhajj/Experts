@extends('layout.app')

@section('title', 'Blogs')

@section('content')

    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit Blog</span></p>
                    <h1 class="mb-3 bread">Blog Edit</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <form method="POST" action="{{ route('blogs.update', $blog) }}" enctype="multipart/form-data" class="search-job p-5 bg-white">
                        @csrf
                        @method('PUT')

                        <h3 class="h5 text-black mb-3" style="color: #fdab44;">Edit Blog</h3>

                        <!-- Title -->
                        <div class="form-group mb-4">
                            <p class="label-fill">Title</p>
                            <div class="form-field">
                                <div class="icon"><span class="icon-bookmark"></span></div>
                                <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="form-control" placeholder="Blog Title">
                            </div>
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Summary -->
                        <div class="form-group mb-4">
                            <p class="label-fill">Summary</p>
                            <div class="form-field">
                                <div class="icon"><span class="icon-text_fields"></span></div>
                                <textarea name="summary" rows="3" class="form-control" placeholder="Short Summary">{{ old('summary', $blog->summary) }}</textarea>
                            </div>
                            @error('summary') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Content -->
                        <div class="form-group mb-4">
                            <p class="label-fill">Content</p>
                            <div class="form-field">
                                <div class="icon"><span class="icon-edit"></span></div>
                                <textarea name="contentBlog" rows="6" class="form-control" placeholder="Full Blog Content">{{ old('contentBlog', $blog->content) }}</textarea>
                            </div>
                            @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                    @php
                        $bgUrl = $blog->hasMedia('blog_image')
                            ? $blog->getFirstMediaUrl('blog_image')
                            : asset('images/image_1.jpg');
                    @endphp
                        <!-- Cover Image -->
                        <div class="form-group mb-4">
                            <p class="label-fill">Cover Image</p>
                            <label class="custom-upload">
                                <img src="{{ $bgUrl }}" id="preview-image" alt="Blog Cover"/>
                                <input type="file" name="image" accept="image/*" onchange="previewProfile(event)">
                            </label>
                            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                            <div id="profile-size-warning" class="alert d-none mt-2 p-2" role="alert"></div>
                        </div>

                        <!-- Publish Status -->
                        <div class="form-group d-flex align-items-center mb-4">
                            <input type="hidden" name="is_published" value="0">
                            <p class="checkbox-label mb-0 ms-2">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                                <span>Publish Immediately</span>
                            </p>
                        </div>

                        <div class="divider-with-icon">
                            <span class="divider-icon">●●●●</span>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn custom-btn-wide">Update Blog</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection
