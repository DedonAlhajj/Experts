<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: calc(3.2rem); /* نفس ارتفاع input */
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        border: 1px solid #e5e5e5;
        border-radius: 0.25rem;
        background-color: #fff;
    }
    .select2-selection__arrow {
        top: 50% !important;
        transform: translateY(-50%) !important;
        right: 10px; /* لتقريب السهم مثل input */
        position: absolute;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #535353; /* غيري اللون حسب رغبتك */
        font-size: 15px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        display: flex;
        align-items: center; /* هذا يحاذيه عاموديًا */
        height: 100%;
        padding-left: 10px; /* نفس هوامش الإدخال */
    }
    .select2-selection--single {
        position: relative;
    }

    .select2-selection__clear {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 10px; /* حسب المساحة المطلوبة بجانب السهم */
        font-size: 1.2rem;
        color: #dc3545;
        cursor: pointer;
        z-index: 10; /* يتأكد أنها فوق باقي العناصر */
    }


    .select2-selection__clear:hover {
        color: #a71d2a;
        opacity: 0.8;
    }


</style>

<div class="hero-wrap img" style="background-image: url(images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-10 d-flex align-items-center ftco-animate">
                <div class="text text-center pt-5 mt-md-5">
                    <p class="mb-4">@setting('home.hero.heading_1')</p>
                    <h1 class="mb-5">@setting('home.hero.heading_2')</h1>
                    <div class="ftco-counter ftco-no-pt ftco-no-pb">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18">
                                    <div class="text d-flex">
                                        <div class="icon mr-2">
                                            <span class="flaticon-worldwide"></span>
                                        </div>
                                        <div class="desc text-left">
                                            <strong class="number" data-number="{{$stats->total_active}}">0</strong>
                                            <span>@setting('home.hero.label_1')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text d-flex">
                                        <div class="icon mr-2">
                                            <span class="flaticon-visitor"></span>
                                        </div>
                                        <div class="desc text-left">
                                            <strong class="number" data-number="{{$stats->total_experts}}">0</strong>
                                            <span>@setting('home.hero.label_2')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text d-flex">
                                        <div class="icon mr-2">
                                            <span class="flaticon-resume"></span>
                                        </div>
                                        <div class="desc text-left">
                                            <strong class="number"
                                                    data-number="{{$stats->total_job_seekers}}">0</strong>
                                            <span>@setting('home.hero.label_3')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ftco-search my-md-5">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                       href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">@setting('form_title1')</a>

                                    <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                                       role="tab" aria-controls="v-pills-2" aria-selected="false">@setting('form_title2')</a>

                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">

                                <div class="tab-content p-4" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                         aria-labelledby="v-pills-nextgen-tab">
                                        <form method="GET" action="{{ route('specializations') }}" class="search-job">
                                            <div class="row no-gutters">
                                                <div class="col-md-9 mr-md-2">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <div class="icon"><span class="icon-briefcase"></span></div>
                                                            <input type="text" name="title"
                                                                   class="form-control"
                                                                   placeholder="eg. Garphic. Web Developer">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <button type="submit" class="form-control btn btn-primary">
                                                                Search
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                         aria-labelledby="v-pills-performance-tab">
                                        <form method="GET" action="{{ route('experts.index') }}" class="search-job">
                                            <div class="row">

                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <div class="form-field">

                                                            <div class="icon"><span
                                                                    class="icon-pencil"></span></div>
                                                            <input type="text" name="title" id="title1"
                                                                   class="form-control" placeholder="eg. Garphic. Web Developer ....">


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <div class="icon"><span class="icon-map-marker"></span>
                                                            </div>
                                                            <select name="location" id="location"
                                                                    class="form-control"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <button type="submit" class="form-control btn btn-primary">
                                                                Search
                                                            </button>
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
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="category-wrap">
                    <div class="row no-gutters">
                        @php
                            $icons = [
                                'flaticon-contact',        // Website & Software
                                'flaticon-mortarboard',    // Education & Training
                                'flaticon-idea',           // Graphic & UI/UX Design
                                'flaticon-accounting',     // Accounting & Finance
                                'flaticon-dish',           // Restaurant & Food
                                'flaticon-stethoscope',    // Health & Hospital
                            ];
                        @endphp

                        @php
                            $fallbackCertificates = [
                                ['title' => 'Website & Software', 'icon' => 'flaticon-contact', 'total' => 0],
                                ['title' => 'Education & Training', 'icon' => 'flaticon-mortarboard', 'total' => 0],
                                ['title' => 'Graphic & UI/UX Design', 'icon' => 'flaticon-idea', 'total' => 0],
                                ['title' => 'CompTIA IT Fundamentals', 'icon' => 'flaticon-accounting', 'total' => 0],
                                ['title' => 'CompTIA A+', 'icon' => 'flaticon-dish', 'total' => 0],
                                ['title' => 'CompTIA Network+', 'icon' => 'flaticon-stethoscope', 'total' => 0],
                            ];

                            $certCount = count($certificates);
                        @endphp


                        @foreach($certificates as $index => $cert)
                            @php
                                $icon = $icons[$index] ?? 'flaticon-layers';
                                $isActive = $index === 1 ? 'active' : '';
                            @endphp

                            <div class="col-md-2">
                                <div class="top-category text-center no-border-left {{ $isActive }}">
                                    <h3 style="display: -webkit-box; -webkit-line-clamp: 2;
                                     -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; height: 59px;">
                                        <a href="{{ route('experts.bySpecialization', ['title' => $cert->display_title]) }}">
                                            {{ $cert->display_title }}
                                        </a>
                                    </h3>
                                    <span class="icon {{ $icon }}"></span>
                                    <p>
                                        <span class="number">{{ $cert->total }}</span>
                                        <span>Open position</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        @for($i = $certCount; $i < 6; $i++)
                            @php
                                $fallback = $fallbackCertificates[$i];
                            @endphp

                            <div class="col-md-2">
                                <div class="top-category text-center no-border-left">
                                    <h3>
                                        <a href="{{ route('experts.bySpecialization', ['title' => $fallback['title']]) }}">
                                            {{ $fallback['title'] }}</a>
                                    </h3>
                                    <span class="icon {{ $fallback['icon'] }}"></span>
                                    <p>
                                        <span class="number">{{ $fallback['total'] }}</span>
                                        <span>Open position</span>
                                    </p>
                                </div>
                            </div>
                        @endfor

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@if(isset($ads['header']) && count($ads['header']))
    <div class="ad-banner-area" style=" padding-top: 30px;">
        <div class="container">
            <div class="swiper ad-banner-swiper" style="height: 96px;">
                <div class="swiper-wrapper">
                    @foreach($ads['header'] as $ad)
                        @php
                            $img = $ad->hasMedia('ad')
                                ? $ad->getFirstMediaUrl('ad')
                                : asset('images/default.jpg');
                        @endphp
                        <div class="swiper-slide">
                            <a href="{{ route('ads.redirect', $ad) }}" target="_blank" class="d-block w-100 h-100">
                                <img src="{{ $img }}"
                                     class="img-fluid"
                                     style="height: 96px; object-fit: cover; width: 100%; display: block;"
                                     alt="{{ $ad->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif




