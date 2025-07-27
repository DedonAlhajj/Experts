@extends('layout.app')

@section('title', 'ads')

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Ads</span></p>
                    <h1 class="mb-3 bread">Our Ads <a href="{{ route('ads.create') }}" class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="icon-add"></i>
                        </a></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light" >
        <div class="container">
            <div class="row d-flex">


                @forelse ($ads as $ad)
                    @php
                        $bgUrl = $ad->hasMedia('ad')
                            ? $ad->getFirstMediaUrl('ad')
                            : asset('images/default.jpg');

                        $startsAt = $ad->start_at?->format('d M Y');
                        $endsAt = $ad->end_at?->format('d M Y');
                        $displayPeriod = ($startsAt && $endsAt)
                            ? "$startsAt → $endsAt"
                            : ($startsAt ?? $endsAt ?? 'Unknown');

                        $isActiveClass = $ad->is_active ? 'bg-success' : 'bg-danger';
                        $isActiveText  = $ad->is_active ? 'Active' : 'Inactive';
                    @endphp

                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch w-100 position-relative overflow-hidden rounded shadow-sm">

                            {{-- 🔹 شريط الحالة --}}
                            <div class="position-absolute top-0 w-100 py-1 text-center text-white {{ $isActiveClass }}"
                                 style="z-index: 2; font-size: 0.8rem;height: 0px;">
                                {{ $isActiveText }}
                            </div>

                            {{-- 🔹 الصورة --}}
                            <div class="position-relative">
                                {{-- 🔹 رابط الإعلان والصورة --}}
                                <a href="{{ $ad->link ?? route('ads.show', $ad) }}"
                                   class="block-20 ratio ratio-16x9 d-block"
                                   style="background-image: url('{{ $bgUrl }}'); background-size: cover; background-position: center; position: relative;">

                                    {{-- ✅ عدد النقرات: الزاوية اليمنى السفلى --}}
                                    <span class="position-absolute text-white bg-dark bg-opacity-75 px-2 py-1 rounded-pill small fw-bold"
                                          style="bottom: 8px; right: 8px; z-index: 3;">
            {{ $ad->clicks }} clicks
        </span>

                                    {{-- 🔴 حالة التفعيل: شريط علوي ملون --}}
                                    <span class="position-absolute w-100 text-center text-white {{ $isActiveClass }}"
                                          style="top: 0; padding: 2px 0; font-size: 0.75rem; z-index: 2;">
            {{ $isActiveText }}
        </span>
                                </a>
                            </div>


                            {{-- 🔹 النصوص --}}
                            <div class="text mt-3 px-3 pb-3">
                                {{-- 🔹 عرض الفترة --}}
                                <div class="meta small text-muted mb-1 d-flex justify-content-between flex-wrap">
        <span>
            <i class="icon-calendar mr-1"></i> {{ $displayPeriod }}
        </span>
                                </div>

                                {{-- 🔹 العنوان أو الوصف --}}
                                <h5 class="heading mb-2 font-weight-bold">
                                    <a href="{{ $ad->link ?? route('ads.show', $ad) }}" class="text-dark">
                                        {{ $ad->description }}
                                    </a>
                                </h5>

                                {{-- 🔹 زر الرابط + أدوات التحكم --}}
                                <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                    {{-- زر الرابط --}}
                                    @if($ad->link)
                                        <a href="{{ route('ads.redirect', $ad) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Visit Link <i class="icon-link"></i>
                                        </a>



                                    @endif

                                    {{-- أدوات التحكم --}}
                                    <div class="d-flex gap-1">
                                        {{-- تعديل الإعلان --}}
                                        <a href="{{ route('ads.edit', $ad) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="icon-pencil"></i>
                                        </a>

                                        {{-- حذف الإعلان --}}
                                        <form method="POST" action="{{ route('ads.destroy', $ad) }}" onsubmit="return confirm('هل أنت متأكد من حذف الإعلان؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-4">
                        <p class="text-muted">No ads available right now</p>
                    </div>
                @endforelse



            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        @include('layout.pagination', ['paginator' => $ads])
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
