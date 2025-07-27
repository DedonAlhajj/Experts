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
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit Profile</span></p>
                    <h1 class="mb-3 bread">Profile Edit</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-8 mb-5">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="col-lg-4">
                    @include('profile.partials.update-password-form')

                    <div class="p-4 mb-3 bg-white">
                        @include('profile.partials.delete-user-form')
                    </div>
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
            fetch("{{ url('/api/autocomplete-titles') }}?category=" + category + "&q=" + encodeURIComponent(search))

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
