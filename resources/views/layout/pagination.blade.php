{{--@if ($paginator->hasPages())--}}
{{--    <div class="pagination-custom">--}}
{{--        --}}{{-- السابق --}}
{{--        @if ($paginator->onFirstPage())--}}
{{--            <span class="disabled">&larr;</span>--}}
{{--        @else--}}
{{--            <a href="{{ $paginator->previousPageUrl() }}">&larr;</a>--}}
{{--        @endif--}}

{{--        --}}{{-- التالي --}}
{{--        @if ($paginator->hasMorePages())--}}
{{--            <a href="{{ $paginator->nextPageUrl() }}">&rarr;</a>--}}
{{--        @else--}}
{{--            <span class="disabled">&rarr;</span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--@endif--}}

@if ($paginator->hasPages())
    <div class="pagination-custom">

        {{-- السابق --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">&larr;</span>
        @else
            <a href="{{ $paginator->appends(request()->query())->previousPageUrl() }}">&larr;</a>
        @endif

        {{-- التالي --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->appends(request()->query())->nextPageUrl() }}">&rarr;</a>
        @else
            <span class="disabled">&rarr;</span>
        @endif

    </div>
@endif
