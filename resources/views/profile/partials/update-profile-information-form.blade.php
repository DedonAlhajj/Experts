
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>



    <form id="formTest" method="POST" action="{{ route('profile.update', ['user' => $user->id]) }}" enctype="multipart/form-data" class="search-job p-5 bg-white">
        @csrf
        @method('PATCH')
    <h3 class="h5 text-black mb-3" style="color: #fdab44;">Personal Info</h3>
    <div class="row no-gutters mb-4">
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p class="label-fill">Full Name</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-user"></span></div>
                    <input type="text" id="fullname" name="name"
                           value="{{ old('name', $user->name) }}"
                           class="form-control"
                           placeholder="Enter your full name" required>
                </div>
            </div>
        </div>

        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Birth Date</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-calendar"></span></div>
                    <input name="date_of_birth" type="date" required
                           value="{{old('date_of_birth', $user->date_of_birth?->format('Y-m-d'))}}"
                           class="form-control" placeholder="date of birth">
                </div>
            </div>
        </div>

        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Gender</p>
                <div class="form-field">
                    <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="gender" id="" class="form-control">
                            <option
                                value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>
                                male
                            </option>
                            <option
                                value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>
                                female
                            </option>
                            <option
                                value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>
                                other
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters mb-4">
        <div class="col-md">
            <div class="form-group">
                <p for="fullname" class="label-fill">Bio</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-text_fields"></span></div>
                    <textarea name="bio" id="bio" rows="4"
                              class="form-control"
                              cols="30" rows="5" required
                              placeholder="Your Bio">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label style="color: #999999;" class="mb-2">Select your status:</label>

                {{-- Hidden fields to ensure both values are always sent --}}
                <input type="hidden" name="is_job_seeker" value="0">
                <input type="hidden" name="is_expert" value="0">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_selector" id="job_seeker" value="job_seeker"
                        {{ $user->is_job_seeker ? 'checked' : '' }}>
                    <label style="color: #4c4c4c;" class="form-check-label" for="job_seeker">
                        I'm looking for a job
                    </label>
                </div>

                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="status_selector" id="expert" value="expert"
                        {{ $user->is_expert ? 'checked' : '' }}>
                    <label style="color: #4c4c4c;" class="form-check-label" for="expert">
                        I'm an expert (5+ years experience)
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-field d-flex align-items-center">
                    <input type="hidden" name="available_for_remote" value="0">
                    <p class="checkbox-label mb-0 ms-2">
                        <input type="checkbox" name="available_for_remote" value="1"
                            {{ $user->available_for_remote ? 'checked' : '' }}>
                        <span>Available for Remote Work</span>
                    </p>
                </div>
            </div>
        </div>

    </div>


    <div class="divider-with-icon">
        <span class="divider-icon">●●●●</span>
    </div>

    <h3 class="h5 text-black mb-3" style="color: #fdab44;">Contact Info</h3>
    <div class="row no-gutters mb-4">
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Phone</p>
                <div class="form-field">
{{--                    <div class="icon"><span class="icon-phone"></span></div>--}}
                    <input type="text" id="fullname" name="phone" required
                           value="{{old('phone', $user->phone)}}" class="form-control"
                           placeholder="Phone">
                </div>
            </div>
        </div>
        <div class="col-md mr-md-2">
            <div class="form-group">
                <div class="form-field">
                    {{-- ✉️ عنوان الحقل --}}
                    <p class="label-fill">Email</p>

                    {{-- 🔄 أيقونة البريد --}}
{{--                    <div class="icon"><span class="icon-contact_mail"></span></div>--}}

                    {{-- 📝 حقل الإدخال --}}
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           class="form-control"
                           placeholder="Email"
                           required
                           autocomplete="username">
                </div>

                {{-- ❗ عرض الأخطاء --}}
                @error('email')
                <p class="text-danger mt-1">{{ $message }}</p>
                @enderror

                {{-- 🔍 تحقق من البريد الإلكتروني --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3">
                        <p class="text-sm text-warning">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-sm btn-link text-decoration-underline">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success mt-2 small">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>


    </div>
    <div class="row no-gutters mb-4">
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Country</p>
                <div class="form-field">
{{--                    <div class="icon"><span class="icon-map-marker"></span></div>--}}
                    <input type="text" id="country" name="country"
                           value="{{ old('country', $user->country) }}"
                           class="form-control awesomplete"
                           placeholder="Country" required autocomplete="off" />
                    @error('country')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">City</p>
                <div class="form-field">
{{--                    <div class="icon"><span class="icon-location_city"></span></div>--}}
                    <input type="text" id="city" name="city"
                           value="{{ old('city', $user->city) }}"
                           class="form-control awesomplete"
                           placeholder="City" required autocomplete="off" />

                    @error('city')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters mb-4">
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Nationality</p>
                <div class="form-field">
{{--                    <div class="icon"><span class="icon-flag"></span></div>--}}
                    <input type="text" id="nationality" name="nationality"
                           value="{{ old('nationality', $user->nationality) }}"
                           class="form-control awesomplete"
                           placeholder="Nationality" autocomplete="off" />
                    @error('nationality')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Address</p>
                <div class="form-field">
{{--                    <div class="icon"><span class="icon-home"></span></div>--}}
                    <input type="text" id="address" name="address"
                           value="{{ old('address', $user->address) }}"
                           class="form-control"
                           placeholder="Address">
                    @error('address')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters mb-4">
        <div class="col-md">
            <div class="form-group">
                <p for="fullname" class="label-fill">Social Link</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-web"></span></div>
                    <input type="url"
                           name="social_links[website]"
                           id="social_links[website]"
                           value="{{ old('social_links.website', $user->social_links['website'] ?? '') }}"
                           class="form-control"
                           placeholder="Website URL">
                    @error('social_links.linkedin')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters mb-4 align-items-center">
        {{-- صورة المعاينة --}}
        <div class="col-md-4">
            <label class="custom-upload">
                <div class="upload-box text-center">
                    <i class="fas fa-cloud-upload-alt fs-2 mb-2"></i>
                    <p class="small mb-0">Select Image</p>
                </div>
                <input type="file" name="profile_image" accept="image/*" onchange="previewProfile2(event)">
            </label>
            @error('profile_image')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
            <div id="profile-size-warning" class="alert d-none mt-2 p-2" role="alert"></div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <img id="preview-image"
                 src="{{ $user->getFirstMediaUrl('profile_image') ?? '#' }}"
                 alt="Profile Image"
                 class="img-fluid rounded border"
                 style="max-height: 200px; display: {{ $user->hasMedia('profile_image') ? 'block' : 'none' }};"
            />
        </div>

        {{-- مربع رفع الصورة --}}

    </div>


    <div class="row no-gutters mb-4 align-items-center">
        <div class="col-md-8">
            @php
                $cvUrl = $user->hasMedia('cv_file')
                  ? $user->getFirstMediaUrl('cv_file')
                  : null;
            @endphp

            {{-- مربع رفع الـ PDF --}}
            <label class="custom-file-upload d-block">
                <div class="upload-box text-center py-3">
                    <i class="fas fa-file-upload fs-3 mb-2"></i>
                    <p class="small mb-0">Select CV (PDF)</p>
                </div>
                <input type="file" name="cv_file" accept=".pdf" onchange="updateFileName2(event)">
                <span id="cv-file-name" class="small text-muted d-block mt-1"></span>

            </label>

            {{-- أيقونة التنزيل --}}
            @if ($cvUrl)
                <a href="{{ $cvUrl }}" target="_blank" title="Download CV" style="display: flex; align-items: center; gap: 8px;">
                    <div class="icon download-icon">
                        <span class="icon-download"></span>
                    </div>
                    <span class="small text-muted">Your Cv</span>
                </a>
            @endif


            @error('cv_file')
            <span class="text-danger small d-block mt-1">{{ $message }}</span>
            @enderror
            <div id="cv-size-warning" class="alert d-none mt-2 p-2" role="alert"></div>
        </div>
    </div>


    <div class="divider-with-icon">
        <span class="divider-icon">●●●●</span>
    </div>


    <h3 class="h5 text-black mb-3" style="color: #fdab44;">Professional Info</h3>





    @php
        // تقسيم البيانات حسب الفئة
        $skills = $expert_infos['skill'] ?? collect();
        $certificates = $expert_infos['certificate'] ?? collect();
        $portfolios = $expert_infos['portfolio'] ?? collect();
        $experiences = $expert_infos['experience'] ?? collect();

        // فهرسة أول إدخال ديناميكي تبدأ بعد عدد كل العناصر القديمة
        $initialIndex = $portfolios->count();
    @endphp


{{--    <div class="form-group mb-4">--}}
{{--        <label class="field-label text-primary">Skills</label>--}}
{{--        <div id="skills-tags-container">--}}
{{--            @foreach($skills as $item)--}}
{{--                <span class="skill-tag">--}}
{{--                {{ $item->title }}--}}
{{--                <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>--}}
{{--            </span>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <input type="text" id="skill-input" class="form-control" placeholder="Enter skill and press Enter">--}}
{{--        <input type="hidden" name="skills_json" id="hidden-skills-input">--}}
{{--    </div>--}}

    {{-- 🧠 Hidden counter --}}
    <script>let experienceIndex = {{ $initialIndex }};</script>


        <div class="form-group mb-4">
            <label class="field-label text-primary">Skills</label>
            <div id="skills-tags-container" class="d-flex flex-wrap gap-2 mb-2">
                @foreach($skills as $item)
                    <span class="skill-tag badge bg-primary text-white d-flex align-items-center">
                {{ $item->title }}
                <button type="button" class="btn-close btn-close-white ms-2" aria-label="Close"></button>
            </span>
                @endforeach
            </div>
            <input type="text" id="skill-input" class="form-control" placeholder="Enter skill and press Enter">
            <div id="skill-warning" class="input-warning">⚠️Maximum 255 characters allowed.</div>
            <input type="hidden" name="skills_json" id="hidden-skills-input">

        </div>




        <div class="form-group mb-4">
        <label class="field-label text-warning">Certificates</label>
        <div id="certificates-tags-container" class="d-flex flex-wrap gap-2 mb-2">
            @foreach($certificates as $item)
                {{-- 💡 استخدام bg-warning ليكون اللون أصفر --}}
                <span class="skill-tag badge bg-warning text-white d-flex align-items-center">
                {{ $item->title }}
                <button type="button" class="btn-close btn-close-white ms-2" aria-label="Close"></button>
            </span>
            @endforeach
        </div>
            <input type="text" id="certificate-input" class="form-control" placeholder="Enter certificate title and press Enter">
            <div id="certificate-warning" class="input-warning">⚠️Maximum 255 characters allowed.</div>
            <input type="hidden" name="certificates_json" id="hidden-certificates-input">

        </div>


    <div class="form-group mb-4">
        <label class="field-label text-success">Experiences</label>
        <div style="" id="experiences-tags-container" class="d-flex flex-wrap gap-2 mb-2">
            @foreach($experiences as $item)
                {{-- 💡 استخدام bg-success ليكون اللون أخضر --}}
                <span class="skill-tag badge bg-success text-white d-flex align-items-center">
                {{ $item->title }}
                <button type="button" class="btn-close btn-close-white ms-2" aria-label="Close"></button>
            </span>
            @endforeach
        </div>
        <input type="text" id="experience-input" class="form-control" placeholder="Enter experience title and press Enter">
        <div id="experience-warning" class="input-warning">⚠️Maximum 255 characters allowed.</div>
        <input type="hidden" name="experiences_json" id="hidden-experiences-input">

    </div>


        <div class="form-group mb-4">
            <label class="field-label text-info">
                Your Portfolio (Add a project title and a brief description to showcase your expertise)
            </label>
            <div id="portfolios-wrapper">
                @foreach($portfolios as $i => $item)
                    @php $index = $i; @endphp
                    <div class="form-field d-flex flex-column gap-2 mb-3">
                        <div class="d-flex gap-3">
                            <div class="icon"><span class="icon-briefcase"></span></div>
                            <input type="hidden" name="experiences[{{ $index }}][category]" value="portfolio">
                            <input type="text" required maxlength="255"
                                   name="experiences[{{ $index }}][title]"
                                   class="form-control awesomplete portfolio-input"
                                   data-category="portfolio"
                                   value="{{ $item->title }}"
                                   placeholder="Enter portfolio">
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
                        </div>
                        <div class="portfolio-warning text-danger small d-none">⚠️Maximum 255 characters allowed.</div>
                    </div>
                @endforeach
            </div>
            <button type="button"
                    onclick="addField('portfolios-wrapper', 'portfolio', 'icon-briefcase', 'Enter portfolio')"
                    class="btn btn-sm btn-outline-info">+ Add Portfolio</button>
        </div>







        <div class="row form-group">
        <div class="col-md-12 text-center">
            <input type="submit" value="Post" class="btn custom-btn-wide">
        </div>
    </div>



</form>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // انتظر قليلًا لتكون كل العناصر موجودة
        setTimeout(() => {
            document.querySelectorAll("input.awesomplete").forEach(function (input) {
                const category = input.dataset.category;

                // 🔥 التهيئة اليدوية وضمان الربط
                const awesomplete = new Awesomplete(input, {
                    list: [],
                    minChars: 1,
                    maxItems: 10,
                    autoFirst: true,
                    filter: () => true,
                    sort: false
                });

                input.awesomplete = awesomplete; // ⛑️ الربط اليدوي

                input.addEventListener("input", function () {
                    const search = input.value;

                    if (search.length < 1) return;

                    fetch(`/api/autocomplete-titles?category=${category}&q=${encodeURIComponent(search)}`)
                        .then(response => response.json())
                        .then(data => {
                            input.awesomplete.list = data;
                            input.awesomplete.evaluate(); // ⛑️ ضروري لعرض النتائج
                        })
                        .catch(error => console.error("Autocomplete fetch error:", error));
                });
            });
        }, 100); // ⏳ تأخير بسيط للتأكد أن العناصر موجودة
    });
</script>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const countryInput = document.getElementById("country");
        const cityInput = document.getElementById("city");
        const nationalityInput = document.getElementById("nationality");

        let countriesList = [];

        // 1. جلب أسماء الدول
        fetch("https://countriesnow.space/api/v0.1/countries/positions")
            .then(res => res.json())
            .then(data => {
                countriesList = data.data.map(c => c.name);
                countryInput.awesomplete = new Awesomplete(countryInput, {
                    list: countriesList,
                    minChars: 1,
                    maxItems: 10,
                    autoFirst: true
                });

                nationalityInput.awesomplete = new Awesomplete(nationalityInput, {
                    list: countriesList.map(name => name + 'ian'), // مثال بسيط للجنسية
                    minChars: 1,
                    maxItems: 10,
                    autoFirst: true
                });
            });

        // 2. عند اختيار دولة، جلب المدن الخاصة بها
        countryInput.addEventListener("blur", function () {
            const selectedCountry = countryInput.value;
            fetch("https://countriesnow.space/api/v0.1/countries/cities", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ country: selectedCountry })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.error) return;

                    new Awesomplete(cityInput, {
                        list: data.data,
                        minChars: 1,
                        maxItems: 10,
                        autoFirst: true
                    });
                })
                .catch(err => console.error("City fetch failed", err));
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jobSeekerRadio = document.getElementById('job_seeker');
        const expertRadio = document.getElementById('expert');

        jobSeekerRadio.addEventListener('change', function () {
            document.querySelector('input[name="is_job_seeker"]').value = 1;
            document.querySelector('input[name="is_expert"]').value = 0;
        });

        expertRadio.addEventListener('change', function () {
            document.querySelector('input[name="is_job_seeker"]').value = 0;
            document.querySelector('input[name="is_expert"]').value = 1;
        });

        // Trigger initial state
        if (jobSeekerRadio.checked) {
            jobSeekerRadio.dispatchEvent(new Event('change'));
        } else if (expertRadio.checked) {
            expertRadio.dispatchEvent(new Event('change'));
        }
    });
</script>
