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
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Create Setting</span></p>
                    <h1 class="mb-3 bread">Setting Create</h1>
                </div>
            </div>
        </div>
    </div>


                    <section class="ftco-section bg-light">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6 ftco-animate">
                                    <div class="bg-white p-4 rounded shadow-sm">

                                        <h4 class="mb-4">Add new Setting</h4>

                                        <form method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data">
                                            @csrf

                                            {{-- المفتاح --}}
                                            <div class="mb-3">
                                                <label for="key" class="form-label">Name Setting</label>
                                                <input type="text" name="key" class="form-control" value="{{ old('key') }}" required>
                                            </div>

                                            {{-- نوع القيمة --}}

                                            <div class="mb-3">
                                                <label for="type" class="form-label">Type</label>
                                                <select name="type" id="setting-type" class="form-control" required>
                                                    <option value="text">نص</option>
                                                    <option value="email">بريد إلكتروني</option>
                                                    <option value="number">رقم</option>
                                                    <option value="boolean">Boolean</option>
                                                    <option value="image">صورة</option>
                                                    <option value="link">رابط</option>
                                                </select>
                                            </div>

                                            {{-- القيمة الديناميكية --}}
                                            <div class="mb-3" id="value-field">
                                                {{-- يتم استبداله تلقائيًا بـ JS --}}
                                            </div>

                                            <div class="mb-3">
                                                <label for="group" class="form-label">Group</label>
                                                <input type="text" name="group" class="form-control" value="{{ old('group') }}">
                                            </div>

                                            {{-- الوصف --}}
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100">Store</button>
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



