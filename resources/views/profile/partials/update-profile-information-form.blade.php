
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>


<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
      class="search-job p-5 bg-white">
    @csrf
    @method('patch')

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
                           placeholder="Enter your full name">
                </div>
            </div>
        </div>

        <div class="col-md mr-md-2">
            <div class="form-group">
                <p for="fullname" class="label-fill">Birth Date</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-calendar"></span></div>
                    <input name="date_of_birth" type="date"
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
                              cols="30" rows="5"
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
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-field d-flex align-items-center">
                    <input type="hidden" name="is_job_seeker" value="0">
                    <p class="checkbox-label mb-0 ms-2">
                        <input type="checkbox" name="is_job_seeker" value="1"
                            {{ $user->is_job_seeker ? 'checked' : '' }}>
                        <span>Are you looking for a job?</span>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="row no-gutters mb-4">
        <div class="col-md-4">
            <div class="form-group">
                <div class="form-field d-flex align-items-center">
                    <input type="hidden" name="is_expert" value="0">
                    <p class="checkbox-label mb-0 ms-2">
                        <input type="checkbox" name="is_expert" value="1"
                            {{ $user->is_expert ? 'checked' : '' }}>
                        <span>Are you an expert?</span>
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
                    <div class="icon"><span class="icon-phone"></span></div>
                    <input type="text" id="fullname" name="phone"
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
                    <div class="icon"><span class="icon-contact_mail"></span></div>

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
                    <div class="icon"><span class="icon-map-marker"></span></div>
                    <input type="text" id="country" name="country"
                           value="{{ old('country', $user->country) }}"
                           class="form-control awesomplete"
                           placeholder="Country" autocomplete="off" />
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
                    <div class="icon"><span class="icon-location_city"></span></div>
                    <input type="text" id="city" name="city"
                           value="{{ old('city', $user->city) }}"
                           class="form-control awesomplete"
                           placeholder="City" autocomplete="off" />

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
                    <div class="icon"><span class="icon-flag"></span></div>
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
                    <div class="icon"><span class="icon-home"></span></div>
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
                <input type="file" name="profile_image" accept="image/*" onchange="previewProfile1(event)">
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
                <input type="file" name="cv_file" accept=".pdf" onchange="updateFileName1(event)">
                <span id="cv-file-name" class="small text-muted d-block mt-1"></span>

            </label>

            {{-- أيقونة التنزيل --}}
            @if ($cvUrl)
                <a href="{{ $cvUrl }}" target="_blank" title="Download CV" style="display: flex; align-items: center; gap: 8px;">
                    <div class="icon download-icon">
                        <span class="icon-download"></span>
                    </div>
                    <span class="small text-muted">{{ basename($cvUrl) }}</span>
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
        $initialIndex = $skills->count() + $certificates->count() + $portfolios->count() + $experiences->count();
    @endphp

    {{-- 🧠 Hidden counter --}}
    <script>let experienceIndex = {{ $initialIndex }};</script>

    {{-- 👇 كل مجموعة تستخدم JavaScript فقط لإضافة الحقول الجديدة --}}
    <div class="form-group mb-4">
        <label class="field-label text-primary">Skill Title</label>
        <div id="skills-wrapper">
            @foreach($skills as $i => $item)
                <div class="form-field d-flex gap-3 mb-2">
                    <div class="icon"><span class="icon-bulb"></span></div>
                    <input type="hidden" name="experiences[{{ $i }}][category]" value="skill">
                    <input type="text" required
                           name="experiences[{{ $i }}][title]"
                           class="form-control awesomplete"
                           data-category="skill"
                           value="{{ $item->title }}"
                           placeholder="Enter skill">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addField('skills-wrapper', 'skill', 'icon-bulb', 'Enter skill')" class="btn btn-sm btn-outline-primary">+ Add Skill</button>
    </div>

    <div class="form-group mb-4">
        <label class="field-label text-warning">Certificate Title</label>
        <div id="certificates-wrapper">
            @foreach($certificates as $i => $item)
                @php $index = $skills->count() + $i; @endphp
                <div class="form-field d-flex gap-3 mb-2">
                    <div class="icon"><span class="icon-award"></span></div>
                    <input type="hidden" name="experiences[{{ $index }}][category]" value="certificate">
                    <input type="text" required
                           name="experiences[{{ $index }}][title]"
                           class="form-control awesomplete"
                           data-category="certificate"
                           value="{{ $item->title }}"
                           placeholder="Enter certificate">

                    <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addField('certificates-wrapper', 'certificate', 'icon-award', 'Enter certificate')" class="btn btn-sm btn-outline-warning">+ Add Certificate</button>
    </div>

    <div class="form-group mb-4">
        <label class="field-label text-info">Portfolio Title</label>
        <div id="portfolios-wrapper">
            @foreach($portfolios as $i => $item)
                @php $index = $skills->count() + $certificates->count() + $i; @endphp
                <div class="form-field d-flex gap-3 mb-2">
                    <div class="icon"><span class="icon-briefcase"></span></div>
                    <input type="hidden" name="experiences[{{ $index }}][category]" value="portfolio">
                    <input type="text" required
                           name="experiences[{{ $index }}][title]"
                           class="form-control awesomplete"
                           data-category="portfolio"
                           value="{{ $item->title }}"
                           placeholder="Enter portfolio">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addField('portfolios-wrapper', 'portfolio', 'icon-briefcase', 'Enter portfolio')" class="btn btn-sm btn-outline-info">+ Add Portfolio</button>
    </div>

    <div class="form-group mb-4">
        <label class="field-label text-success">Experience Title</label>
        <div id="experiences-wrapper">
            @foreach($experiences as $i => $item)
                @php $index = $skills->count() + $certificates->count() + $portfolios->count() + $i; @endphp
                <div class="form-field d-flex gap-3 mb-2">
                    <div class="icon"><span class="icon-rocket"></span></div>
                    <input type="hidden" name="experiences[{{ $index }}][category]" value="experience">
                    <input type="text" required
                           name="experiences[{{ $index }}][title]"
                           class="form-control awesomplete"
                           data-category="experience"
                           value="{{ $item->title }}"
                           placeholder="Enter experience">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeField(this)">✖</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addField('experiences-wrapper', 'experience', 'icon-rocket', 'Enter experience')" class="btn btn-sm btn-outline-success">+ Add Experience</button>
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
