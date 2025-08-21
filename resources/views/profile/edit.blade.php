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

        /* تنسيق عام للحاويات التي تحتوي على الوسوم */
        #skills-tags-container,
        #certificates-tags-container,
        #experiences-tags-container {
            display: flex;
            flex-wrap: wrap; /* يسمح للوسوم بالانتقال إلى سطر جديد */
            gap: 0.5rem;      /* تباعد بين كل وسم والآخر */
            margin-bottom: 1rem;
            min-height: 40px; /* يمنع الحاوية من الانهيار عندما تكون فارغة */

        }

        /* تنسيق الوسم نفسه */
        .skill-tag {
            /* ستايل أساسي ليصبح الوسم أنيقًا */
            padding: 0.3rem 0.8rem; /* تباعد داخلي مناسب */
            border-radius: 50px;    /* حواف دائرية */
            font-size: 0.9rem;      /* حجم خط مناسب */
            display: flex;
            align-items: center;
            gap: 0.5rem;            /* تباعد بين نص الوسم وزر الإغلاق */

            white-space: normal;
            word-break: break-word;
            max-width: 100%;

        }

        /* تنسيق زر الإغلاق داخل الوسم */
        .skill-tag .btn-close {
            font-size: 0.7rem;      /* تصغير حجم زر الإغلاق */
            opacity: 0.8;           /* شفافية طفيفة */
        }

        /* تأثير عند المرور على زر الإغلاق */
        .skill-tag .btn-close:hover {
            opacity: 1;             /* زيادة الشفافية */
        }

        .input-warning {
            display: none;
            margin-top: 6px;
            padding: 8px 12px;
            background-color: #ffe5e5;
            border-left: 4px solid #dc3545;
            color: #a94442;
            font-size: 0.875rem;
            border-radius: 4px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .input-warning.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .portfolio-warning {
            display: none;
            font-size: 0.85rem;
            color: #dc3545;
            margin-top: 4px;
        }

        .portfolio-warning:not(.d-none) {
            display: block;
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

            <!-- التنبيه الاحترافي -->
            <div class="alert alert-warning d-flex align-items-center mb-4" role="alert" style="font-weight: 500;">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span>
                    @setting('profile_warning_message')
                </span>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="col-lg-4" style="    margin-top: 16px;">
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
    function attachValidationToExistingInputs() {
        const inputs = document.querySelectorAll('.portfolio-input');

        inputs.forEach(input => {
            const warning = input.parentElement.parentElement.querySelector('.portfolio-warning');

            if (!warning) return; // حماية إضافية

            input.addEventListener("input", function () {
                if (this.value.length > 255) {
                    this.value = this.value.slice(0, 255);
                    warning.classList.remove('d-none');
                } else {
                    warning.classList.add('d-none');
                }
            });

            input.addEventListener("keydown", function (e) {
                const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Enter'];
                if (this.value.length >= 255 && !allowedKeys.includes(e.key) && !e.ctrlKey) {
                    e.preventDefault();
                    warning.classList.remove('d-none');
                }
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        attachValidationToExistingInputs();
    });

    function addField(wrapperId, category, iconClass, placeholder) {
        const wrapper = document.getElementById(wrapperId);
        const html = `
        <div class="form-field d-flex flex-column gap-2 mb-3">
            <div class="d-flex gap-3">
                <div class="icon"><span class="${iconClass}"></span></div>
                <input type="hidden" name="experiences[${experienceIndex}][category]" value="${category}">
                <input type="text" required maxlength="255"
                       name="experiences[${experienceIndex}][title]"
                       class="form-control awesomplete portfolio-input"
                       data-category="${category}"
                       placeholder="${placeholder}">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
            </div>
            <div class="portfolio-warning text-danger small d-none">⚠️Maximum 255 characters allowed.</div>
        </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);

        const inputs = wrapper.querySelectorAll('.portfolio-input');
        const lastInput = inputs[inputs.length - 1];
        const warning = lastInput.parentElement.parentElement.querySelector('.portfolio-warning');

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
            if (this.value.length > 255) {
                this.value = this.value.slice(0, 255);
                warning.classList.remove('d-none');
            } else {
                warning.classList.add('d-none');
            }

            const search = this.value;
            if (search.length < 1) return;

            fetch("{{ url('/api/autocomplete-titles') }}?category=" + category + "&q=" + encodeURIComponent(search))
                .then(response => response.json())
                .then(data => {
                    lastInput.awesomplete.list = data;
                    lastInput.awesomplete.evaluate();
                })
                .catch(error => console.error("Autocomplete fetch error:", error));
        });

        lastInput.addEventListener("keydown", function (e) {
            const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Enter'];
            if (this.value.length >= 255 && !allowedKeys.includes(e.key) && !e.ctrlKey) {
                e.preventDefault();
                warning.classList.remove('d-none');
            }
        });

        experienceIndex++;
    }

    function removeField(button) {
        button.closest('.form-field').remove();
    }
</script>





<script>
    document.addEventListener('DOMContentLoaded', function () {

        function setupTagInput(containerId, inputId, hiddenInputId, category, colorClass, warningId) {
            const input = document.getElementById(inputId);
            const container = document.getElementById(containerId);
            const hiddenInput = document.getElementById(hiddenInputId);
            const warning = document.getElementById(warningId);
            let itemsArray = [];

            // تهيئة البيانات الموجودة مسبقًا
            container.querySelectorAll('.skill-tag').forEach(tag => {
                const title = tag.textContent.trim().replace(/[\n\r\t×]/g, '');
                itemsArray.push({ category: category, title: title });
            });
            updateHiddenInput();

            // إعداد Awesomplete
            const awesomplete = new Awesomplete(input, {
                list: [],
                minChars: 1,
                maxItems: 10,
                autoFirst: true,
                filter: () => true,
                sort: false
            });

            // منع الإدخال بعد 255 حرفًا
            input.addEventListener("keydown", function (e) {
                const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Enter'];
                if (this.value.length >= 255 && !allowedKeys.includes(e.key) && !e.ctrlKey) {
                    e.preventDefault();
                    warning.classList.add('show');
                }
            });

            // مراقبة الإدخال وعرض التنبيه
            input.addEventListener("input", function () {
                if (this.value.length > 255) {
                    this.value = this.value.slice(0, 255); // قص الزائد
                    warning.classList.add('show');
                } else {
                    warning.classList.remove('show');
                }

                const search = this.value;
                if (search.length < 1) return;

                fetch("{{ url('/api/autocomplete-titles') }}?category=" + category + "&q=" + encodeURIComponent(search))
                    .then(response => response.json())
                    .then(data => {
                        awesomplete.list = data;
                        awesomplete.evaluate();
                    });
            });

            // إضافة الوسم عند الضغط على Enter
            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const itemValue = this.value.trim();

                    if (itemValue.length > 255) {
                        warning.classList.add('show');
                        return;
                    }

                    if (itemValue) {
                        const newTag = document.createElement('span');
                        newTag.classList.add('skill-tag', 'badge', colorClass, 'text-white', 'd-flex', 'align-items-center');
                        newTag.textContent = itemValue;

                        const removeBtn = document.createElement('button');
                        removeBtn.classList.add('btn-close', 'btn-close-white', 'ms-2');
                        removeBtn.type = 'button';
                        removeBtn.setAttribute('aria-label', 'Close');
                        newTag.appendChild(removeBtn);

                        container.appendChild(newTag);
                        itemsArray.push({ category: category, title: itemValue });
                        updateHiddenInput();
                        this.value = '';
                        warning.classList.remove('show');
                        awesomplete.close();
                    }
                }
            });

            // حذف الوسم
            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-close')) {
                    const tag = e.target.parentElement;
                    const title = tag.textContent.trim().replace(/[\n\r\t×]/g, '');
                    itemsArray = itemsArray.filter(item => item.title !== title);
                    tag.remove();
                    updateHiddenInput();
                }
            });

            // تحديث الحقل المخفي
            function updateHiddenInput() {
                hiddenInput.value = JSON.stringify(itemsArray);
            }
        }

        // استدعاء الدالة لكل فئة
        setupTagInput('skills-tags-container', 'skill-input', 'hidden-skills-input', 'skill', 'bg-primary', 'skill-warning');
        setupTagInput('certificates-tags-container', 'certificate-input', 'hidden-certificates-input', 'certificate', 'bg-warning', 'certificate-warning');
        setupTagInput('experiences-tags-container', 'experience-input', 'hidden-experiences-input', 'experience', 'bg-success', 'experience-warning');
    });
</script>

