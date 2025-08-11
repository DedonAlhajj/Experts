@extends('layout.app')

@section('title', 'New Newsletter')

@section('content')

    <style>
        .label-fill {
            font-size: 14px;
            font-weight: 700;
            color: #999999;
            margin-bottom: 5px;
        }
    </style>
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Create Newsletter</span></p>
                    <h1 class="mb-3 bread">Newsletter Create</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <form method="POST" action="{{ route('newsletters.store') }}" enctype="multipart/form-data" class="search-job p-5 bg-white">
                        @csrf

                        <h3 class="h5 text-black mb-3" style="color: #fdab44;">Create New Newsletter</h3>

                        {{-- Title --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Title</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-bookmark"></span></div>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                               placeholder="Catchy newsletter title">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md">
                                <div class="form-group">
                                    <p class="label-fill">Content</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-text_fields"></span></div>
                                        <textarea name="body" rows="6" class="form-control"
                                                  placeholder="Engaging text, tips or offers">{{ old('body') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Optional Image --}}


                        <div class="row no-gutters mb-4">


                            <div class="col-md mr-md-2">

                                <label class="custom-upload">
                                    {{-- معاينة أولية --}}
                                    <img src="{{asset('images/default.jpg')}}" id="preview-image" alt="Ad Image"/>
                                    <input type="file" name="image" accept="image/*"
                                           onchange="previewProfile(event)">
                                </label>
                                @error('image')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <div id="profile-size-warning" class="alert d-none mt-2 p-2" role="alert"></div>
                            </div>
                        </div>

                        <h3 class="h5 text-black mb-3 mt-4" style="color: #fdab44;">Call to Action</h3>

                        {{-- CTA Label and URL --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">CTA Button Text</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-textsms"></span></div>
                                        <input type="text" name="cta_label" value="{{ old('cta_label') }}" class="form-control"
                                               placeholder="e.g. Learn more">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">CTA Link</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-link"></span></div>
                                        <input type="url" name="cta_url" value="{{ old('cta_url') }}" class="form-control"
                                               placeholder="https://example.com/offer">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Scheduled Send Time --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Send At (optional)</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-calendar_today"></span></div>
                                        <input type="datetime-local" name="send_at" value="{{ old('send_at') }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="h5 text-black mb-3 mt-4" style="color: #fdab44;">Scheduling Options</h3>

                        <div class="row no-gutters mb-4">
                            <div class="col-md">
                                <div class="form-group">
                                    <p class="label-fill">Repeat Type</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-refresh"></span></div>
                                        <select name="repeat_type" class="form-control">
                                            <option value="none">None</option>
                                            <option value="daily" {{ old('repeat_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                                            <option value="weekly" {{ old('repeat_type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="monthly" {{ old('repeat_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters mb-4">
                            <div class="col-md">
                                <div class="form-group">
                                    <p class="label-fill">Repeat Interval</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-timer"></span></div>
                                        <input type="number" min="1" name="repeat_interval"
                                               value="{{ old('repeat_interval') }}"
                                               class="form-control" placeholder="e.g. Every 2 days">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider-with-icon">
                            <span class="divider-icon">●●●●</span>
                        </div>

                        {{-- Submit --}}
                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn custom-btn-wide">Save Newsletter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection

