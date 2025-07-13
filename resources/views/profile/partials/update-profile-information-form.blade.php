
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
                           class="form-control"
                           placeholder="Country">
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
                           class="form-control"
                           placeholder="City">
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
                           class="form-control"
                           placeholder="Nationality">
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
    <div class="row no-gutters mb-4">
        <div class="col-md-4">
            <label class="custom-upload">
                {{-- معاينة أولية --}}
                @php
                    $bgUrl = $user->hasMedia('profile_image')
                        ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(),
                        $user->getFirstMediaUrl('profile_image'))
                        : asset('images/default.jpg');
                @endphp
                <img id="preview-image" src="{{$bgUrl }}" alt="Profile Image"/>
                <input type="file" name="profile_image" accept="image/*"
                       onchange="previewProfile(event)">
            </label>
            @error('profile_image')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-8">
            @php
                $cvUrl = $user->hasMedia('cv_file')
                  ? str_replace(config('app.url'), request()->getSchemeAndHttpHost(), $user->getFirstMediaUrl('cv_file'))
                  : null;
            @endphp

            <label class="custom-file-upload"><span id="cv-file-name">{{ $cvUrl ? 'Current file: ' . basename($cvUrl) : 'Click to upload CV (PDF)' }}</span>
                <input type="file" name="cv_file" accept=".pdf" onchange="updateFileName(event)">
            </label>

            @if ($cvUrl)
                <a href="{{ $cvUrl }}" target="_blank" title="Download CV">
                    <div class="icon download-icon">
                        <span class="icon-download"></span>
                    </div>
                </a>
            @endif



            @error('cv_file')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
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
                    <input type="text" name="experiences[{{ $i }}][title]" class="form-control" value="{{ $item->title }}" placeholder="Enter skill">
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
                    <input type="text" name="experiences[{{ $index }}][title]" class="form-control" value="{{ $item->title }}" placeholder="Enter certificate">
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
                    <input type="text" name="experiences[{{ $index }}][title]" class="form-control" value="{{ $item->title }}" placeholder="Enter portfolio">
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
                    <input type="text" name="experiences[{{ $index }}][title]" class="form-control" value="{{ $item->title }}" placeholder="Enter experience">
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



