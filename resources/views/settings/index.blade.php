@extends('layout.app')

@section('title', 'Setting')

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Settings</span></p>
                    <h1 class="mb-3 bread">Our Setting <a href="{{route('settings.create')}}"
                                                          class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="icon-add"></i>
                        </a></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="ftco-search">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">@setting('form_title3')</a>

                            </div>
                        </div>
                        <div class="col-md-12 tab-wrap">

                            <div class="tab-content p-4" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                                    <form method="GET" action="{{ route('settings.index') }}" class="search-job">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-field">
                                                        <div class="icon"><span class="icon-user"></span></div>
                                                        <input type="text" name="group" value="{{request('group')}}" class="form-control" placeholder="Group">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-field">
                                                        <div class="icon"><span class="icon-user"></span></div>
                                                        <input type="text" name="key" value="{{request('key')}}" class="form-control" placeholder="Key">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
            <div class="row d-flex justify-content-center">

                @forelse($settings as $setting)
                    <div class="col-md-6 col-lg-4 mb-4 ftco-animate">
                        <div class="job-post-item bg-white p-4 d-block rounded shadow-sm position-relative">

                            {{-- العنوان والمفتاح --}}
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h5 class="mb-0 fw-bold text-primary">{{ $setting->key }}</h5>
                                <span class="badge bg-light text-dark small">{{ $setting->type }}</span>
                            </div>

                            {{-- الوصف --}}
                            @if($setting->description)
                                <p class="text-muted small mb-2">
                                    <i class="icon-info-circle me-1"></i>{{ $setting->description }}
                                </p>
                            @endif



                            {{-- القيمة --}}
                            <div class="border-top pt-3">
{{--                                asset('images/default.jpg')--}}
                                @if($setting->type === 'image')
                                    @if($setting->value)
                                        <img src="{{ asset('storage/' . $setting->value) }}" alt="Setting Image"
                                    @else
                                        <img src="{{  asset('images/default.jpg') }}" alt="Setting Image"
                                    @endif
                                         class="img-fluid rounded border" style="max-height: 150px;">
                                @elseif($setting->type === 'boolean')
                                    <span class="text-{{ $setting->value === 'true' ? 'success' : 'danger' }}">
                                    {{ $setting->value === 'true' ? 'مفعّل' : 'غير مفعّل' }}
                                </span>
                                @else
                                    <span class="text-secondary small">{{ $setting->value }}</span>
                                @endif
                            </div>


                            @if($setting->group)
                                <p class="text-muted small mb-2">
                                    <span class="badge bg-light text-dark small">Grouped By {{ $setting->group }}</span>
                                </p>
                            @endif

                            {{-- زر تعديل وحذف --}}
                            @if($setting->editable)
                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="{{ route('settings.edit', $setting->key) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="icon-pencil"></i> تعديل
                                    </a>
                                    <form method="POST" action="{{ route('settings.destroy', $setting->key) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('هل تريد حذف هذا الإعداد؟')">
                                            <i class="icon-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center text-muted">
                        لا توجد إعدادات حالياً.
                    </div>
                @endforelse

            </div>

            {{-- باجيناشن (إذا أردت عرضها بتقسيم صفحات) --}}
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        @include('layout.pagination', ['paginator' => $settings])
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
