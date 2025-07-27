@extends('layout.app')

@section('title', 'New Newsletter')

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Newsletter</span></p>
                    <h1 class="mb-3 bread">New Newsletter <a href="{{route('newsletters.create')}}"
                                                             class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="icon-add"></i>
                        </a></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center">
                @forelse($newsletters as $newsletter)
                    @php
                        $bgUrl = $newsletter->hasMedia('newsletters')
                            ? $newsletter->getFirstMediaUrl('newsletters')
                            : asset('images/default.jpg');

                    @endphp
                    <div class="col-md-6 col-lg-4 mb-4 ftco-animate">
                        <div class="job-post-item bg-white p-4 d-block rounded shadow-sm position-relative">

                            {{-- Title and Status --}}
                            <div class="d-flex align-items-center justify-content-between mb-2"><h5
                                    class="mb-0 fw-bold text-primary">{{ $newsletter->title }}</h5> <span
                                    class="badge bg-light text-dark small"> {{ $newsletter->is_sent ? 'Sent' : 'Scheduled' }} </span>
                            </div>

                            @if($newsletter->repeat_type !== 'none')
                                <span class="badge bg-info text-white small">
        🔁
        @switch($newsletter->repeat_type)
                                        @case('daily') Every {{ $newsletter->repeat_interval }} day @break
                                        @case('weekly') Every {{ $newsletter->repeat_interval }} week @break
                                        @case('monthly') Every {{ $newsletter->repeat_interval }} month @break
                                    @endswitch
        • Next: {{ $newsletter->next_send_at?->format('Y-m-d H:i') ?? 'Not scheduled' }}

    </span>
                            @endif

                        @if($newsletter->send_at)
                                <div class="d-flex justify-content-between align-items-center mb-2 text-muted small">
                                    <p class="text-muted small mb-2"><i
                                            class="icon-calendar me-1"></i> Will send
                                        at {{ $newsletter->send_at->format('Y-m-d H:i') }}
                                    </p>

                                    {{-- زر إرسال يدوي --}}
                                    <form action="{{ route('newsletters.send', $newsletter->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to send the newsletter?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="icon-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif


                            {{-- Image preview --}}
                            <div class="border-top pt-3"><img src="{{ $bgUrl}}"
                                                              alt="Newsletter Image"
                                                              class="img-fluid rounded border"
                                                              style="max-height: 150px;"></div>


                            {{-- Body preview --}} <p
                                class="text-secondary small mt-3"> {{ Str::limit(strip_tags($newsletter->body), 120) }} </p>

                            {{-- CTA --}} @if($newsletter->cta_label && $newsletter->cta_url) <a
                                href="{{ $newsletter->cta_url }}" target="_blank"
                                class="btn btn-sm btn-outline-primary mt-2"> {{ $newsletter->cta_label }} </a> @endif

                            {{-- Actions --}}
                            <div class="mt-3 d-flex justify-content-between">
                                <a
                                    href="{{ route('newsletters.edit', $newsletter->id) }}"
                                    class="btn btn-sm btn-outline-secondary"> <i class="icon-eye"></i> Edit </a>
                                <form method="POST"
                                      action="{{ route('newsletters.destroyLetters', $newsletter->id) }}"> @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this newsletter?')">
                                        <i class="icon-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div> @empty
                    <div class="col-md-12 text-center text-muted"> No newsletters found.</div> @endforelse </div>

            {{-- Pagination --}} @if(method_exists($newsletters, 'links'))
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27"> @include('layout.pagination', ['paginator' => $newsletters]) </div>
                    </div>
                </div> @endif </div>
    </section>


@endsection
