@extends('layout.app')

@section('title', 'Experts')

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
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit Ad</span></p>
                    <h1 class="mb-3 bread">Ad Edit</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-8 mb-5">

                    <form method="POST" action="{{ route('ads.update', $ad) }}" enctype="multipart/form-data" class="search-job p-5 bg-white">
                        @csrf
                        @method('PUT') {{-- استخدام PUT لأننا نحدث بيانات موجودة --}}

                        <h3 class="h5 text-black mb-3" style="color: #fdab44;">Edit Ad Info</h3>

                        {{-- 🔹 العنوان --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Title</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-bookmark"></span></div>
                                        <input type="text" name="title" value="{{ old('title', $ad->title) }}" class="form-control" placeholder="Ad Title">
                                    </div>
                                </div>
                            </div>

                            {{-- 🔹 الموضع --}}
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Position</p>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="icon-pin"></span></div>
                                            <select name="position" class="form-control">
                                                @foreach(['header', 'sidebar', 'footer', 'inline'] as $pos)
                                                    <option value="{{ $pos }}" {{ old('position', $ad->position) === $pos ? 'selected' : '' }}>
                                                        {{ ucfirst($pos) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 🔹 الوصف --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Description</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-text_fields"></span></div>
                                        <textarea name="description" rows="4" class="form-control" placeholder="Ad Description">{{ old('description', $ad->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 🔹 المدة --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Start At</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-calendar"></span></div>
                                        <input type="date" name="start_at" value="{{ old('start_at', $ad->start_at?->format('Y-m-d')) }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">End At</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-calendar"></span></div>
                                        <input type="date" name="end_at" value="{{ old('end_at', $ad->end_at?->format('Y-m-d')) }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 🔹 الرابط --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <p class="label-fill">Ad Link</p>
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-link"></span></div>
                                        <input type="url" name="link" value="{{ old('link', $ad->link) }}" class="form-control" placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 🔹 صورة الإعلان --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md mr-md-2">
                                <label class="custom-upload">
                                    @php
                                        $bgUrl = $ad->hasMedia('ad')
                                            ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(),
                                            $ad->getFirstMediaUrl('ad'))
                                            : asset('images/default.jpg');
                                    @endphp
                                        <img id="preview-image" src="{{ $bgUrl }}" alt="Ad Image">

                                    <input type="file" name="image" accept="image/*" onchange="previewProfile(event)">
                                </label>
                                @error('image')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <div id="profile-size-warning" class="alert d-none mt-2 p-2" role="alert"></div>
                            </div>
                        </div>

                        {{-- 🔹 الحالة --}}
                        <div class="row no-gutters mb-4">
                            <div class="col-md">
                                <div class="form-group d-flex align-items-center">
                                    <input type="hidden" name="is_active" value="0">
                                    <p class="checkbox-label mb-0 ms-2">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $ad->is_active) ? 'checked' : '' }}>
                                        <span>Active Ad</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- 🔹 زر التحديث --}}
                        <div class="divider-with-icon">
                            <span class="divider-icon">●●●●</span>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn custom-btn-wide">Update Ad</button>
                            </div>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </section>

@endsection
<script>
    function addField(wrapperId, category, iconClass, placeholder) {
        const wrapper = document.getElementById(wrapperId);
        const html = `
        <div class="form-field d-flex gap-3 mb-2">
            <div class="icon"><span class="${iconClass}"></span></div>
            <input type="hidden" name="experiences[${experienceIndex}][category]" value="${category}">
            <input type="text" required
                   name="experiences[${experienceIndex}][title]"
                   class="form-control awesomplete"
                   data-category="${category}"
                   placeholder="${placeholder}">
            <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
        </div>
    `;
        wrapper.insertAdjacentHTML('beforeend', html);

        const input = wrapper.querySelectorAll('.awesomplete[data-category="' + category + '"]');
        const lastInput = input[input.length - 1];

        const awesomplete = new Awesomplete(lastInput, {
            list: [],
            minChars: 1,
            maxItems: 10,
            autoFirst: true,
            filter: () => true,
            sort: false
        });

        lastInput.awesomplete = awesomplete;

        lastInput.addEventListener("input", function () {
            const search = lastInput.value;

            if (search.length < 1) return;

            fetch(`/api/autocomplete-titles?category=${category}&q=${encodeURIComponent(search)}`)
                .then(response => response.json())
                .then(data => {
                    lastInput.awesomplete.list = data;
                    lastInput.awesomplete.evaluate();
                })
                .catch(error => console.error("Autocomplete fetch error:", error));
        });

        experienceIndex++;
    }


    function removeField(button) {
        button.parentElement.remove();
    }

</script>
