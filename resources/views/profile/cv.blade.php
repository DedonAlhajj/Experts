@extends('layout.app')

@section('title', 'Profile')

@section('content')



    <div class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0">
                        <span class="mr-3"><a href="{{route('home')}}">Home
                                <i class="ion-ios-arrow-forward"></i></a>
                        </span>
                        <span>CV</span></p>

                </div>
            </div>
        </div>
    </div>



    {{----------------------------------------------------------------------------------}}


    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            @if($fileUrl)
                <div class="d-flex justify-content-center gap-3 mb-4">
                    <button id="prev-page" class="btn btn-light rounded-circle shadow-sm" title="Previous Page">
                        <i class="icon icon-chevron-left"></i>
                    </button>
                    <button id="next-page" class="btn btn-light rounded-circle shadow-sm" title="Next Page">
                        <i class="icon icon-chevron-right"></i>
                    </button>
                    <button id="zoom-in" class="btn btn-light rounded-circle shadow-sm" title="Zoom In">
                        <i class="icon icon-search-plus"></i>
                    </button>
                    <button id="zoom-out" class="btn btn-light rounded-circle shadow-sm" title="Zoom Out">
                        <i class="icon icon-search-minus"></i>
                    </button>
                </div>


                <canvas id="pdf-canvas" style="width: 100%; border: 1px solid #ccc;"></canvas>
            @else
                <p>لا يوجد ملف سيرة ذاتية</p>
            @endif
        </div>

        <script src="{{ asset('js/pdfjs/pdf.min.js') }}"></script>
        <script>
            pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('js/pdfjs/pdf.worker.min.js') }}";

            const url = "{{ $fileUrl }}";
            const canvas = document.getElementById('pdf-canvas');
            const ctx = canvas.getContext('2d');

            let pdfDoc = null;
            let currentPage = 1;
            let scale = 1.5;

            function renderPage(pageNum) {
                pdfDoc.getPage(pageNum).then(function(page) {
                    const viewport = page.getViewport({ scale: scale });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            }

            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                pdfDoc = pdf;
                renderPage(currentPage);
            });

            document.getElementById('zoom-in').addEventListener('click', function () {
                scale += 0.25;
                renderPage(currentPage);
            });

            document.getElementById('zoom-out').addEventListener('click', function () {
                if (scale > 0.5) {
                    scale -= 0.25;
                    renderPage(currentPage);
                }
            });

            document.getElementById('prev-page').addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    renderPage(currentPage);
                }
            });

            document.getElementById('next-page').addEventListener('click', function () {
                if (currentPage < pdfDoc.numPages) {
                    currentPage++;
                    renderPage(currentPage);
                }
            });
        </script>

    </section> <!-- .section -->







@endsection

