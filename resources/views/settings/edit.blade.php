@extends('layout.app')

@section('title', 'Setting')

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
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit Setting</span></p>
                    <h1 class="mb-3 bread">Setting Edit</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 ftco-animate">
                    <div class="bg-white p-4 rounded shadow-sm">

                        <h4 class="mb-4">Edit Setting: {{ $setting->key }}</h4>

                        <form method="POST" action="{{ route('settings.update', $setting->key) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- المفتاح (غير قابل للتعديل) --}}
                            <div class="mb-3">
                                <label class="form-label">Key (read-only)</label>
                                <input type="text" class="form-control" value="{{ $setting->key }}" readonly>
                            </div>

                            {{-- نوع القيمة (غير قابل للتعديل) --}}
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control" value="{{ $setting->type }}" readonly>
                            </div>

                            {{-- القيمة حسب النوع --}}
                            <div class="mb-3" id="value-field">
                                @if ($setting->type === 'image')
                                    <label class="form-label">Current Image</label><br>
                                    <img src="{{ asset('storage/' . $setting->value) }}" alt="Logo"
                                         class="img-fluid rounded mb-2" style="max-height: 150px;">
                                    <label class="form-label">Replace Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                @elseif ($setting->type === 'boolean')
                                    <label class="form-label">Value</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="value" value="true"
                                            {{ $setting->value === 'true' ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $setting->value === 'true' ? 'Enabled' : 'Disabled' }}</label>
                                    </div>
                                @elseif ($setting->type === 'email')
                                    <label class="form-label">Email</label>
                                    <input type="email" name="value" class="form-control" value="{{ old('value', $setting->value) }}">
                                @elseif ($setting->type === 'number')
                                    <label class="form-label">Number</label>
                                    <input type="number" name="value" class="form-control" value="{{ old('value', $setting->value) }}">
                                @elseif ($setting->type === 'link')
                                    <label class="form-label">URL</label>
                                    <input type="url" name="value" class="form-control" value="{{ old('value', $setting->value) }}">
                                @else
                                    <label class="form-label">Value</label>
                                    <textarea name="value" rows="3" class="form-control">{{ old('value', $setting->value) }}</textarea>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="group" class="form-label">Group</label>
                                <input type="text" name="group" class="form-control" value="{{ old('group', $setting->group) }}">
                            </div>

                            {{-- الوصف --}}
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control"
                                       value="{{ old('description', $setting->description) }}">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Update Setting</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('setting-type');
            const valueField = document.getElementById('value-field');

            function buildField(type) {
                let html = '';
                switch (type) {
                    case 'image':
                        html = `
                    <label for="image" class="form-label">Img</label>
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                `;
                        break;
                    case 'boolean':
                        html = `
                    <label class="form-label d-block">Value(checkbox)</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="value" value="true" checked>
                        <label class="form-check-label">مُفعّل</label>
                    </div>
                `;
                        break;
                    case 'email':
                        html = `
                    <label for="value" class="form-label">Value(email)</label>
                    <input type="email" name="value" class="form-control" required>
                `;
                        break;
                    case 'number':
                        html = `
                    <label for="value" class="form-label">Value(number)</label>
                    <input type="number" name="value" class="form-control" required>
                `;
                        break;
                    case 'link':
                        html = `
                    <label for="value" class="form-label">Value(url)</label>
                    <input type="url" name="value" class="form-control" required>
                `;
                        break;
                    default:
                        html = `
                    <label for="value" class="form-label">Value(text)</label>
                    <textarea name="value" rows="3" class="form-control" required></textarea>
                `;
                }
                valueField.innerHTML = html;
            }

            // حدث عند تغيير النوع
            typeSelect.addEventListener('change', function () {
                buildField(this.value);
            });

            // بناء الحقل عند التحميل
            buildField(typeSelect.value);
        });
    </script>



