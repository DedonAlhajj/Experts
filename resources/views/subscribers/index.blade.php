@extends('layout.app')

@section('title', 'Subscribers')

@section('content')
    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a></span> <span>Subscribers</span></p>
                    <h1 class="mb-3 bread">Our Subscribers</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-md-10"><h2 class="text-center">Newsletter Subscribers List</h2></div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    @if($subscribers && count($subscribers))
                        <div class="table-responsive bg-white shadow-sm rounded p-3">
                            <table class="table table-bordered table-striped table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Email Address</th>
                                    <th>Subscribed At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody> @foreach($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-primary fw-semibold">{{ $subscriber->email }}</td>
                                        <td class="text-muted small">{{ $subscriber->created_at?->format('Y-m-d H:i') ?? 'غير محدد' }}</td>
                                        <td>
                                            <form method="POST"
                                                  action="{{ route('newsletter.destroy', $subscriber->id) }}"> @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('هل تريد حذف هذا الاشتراك؟')"> 🗑️ حذف
                                                </button>
                                            </form>
                                        </td>
                                    </tr> @endforeach </tbody>
                            </table>
                        </div> @else
                        <div class="text-center text-muted"> لا توجد اشتراكات حالياً.</div> @endif </div>
            </div>

            @if(method_exists($subscribers, 'links'))
                <div class="row mt-4">
                    <div class="col text-center"> @include('layout.pagination', ['paginator' => $subscribers]) </div>
                </div> @endif </div>
    </section>



@endsection
