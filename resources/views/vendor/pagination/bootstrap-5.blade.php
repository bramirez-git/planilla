@if ($paginator->hasPages())
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="text-nowrap align-self-center align-self-sm-start  pt-3">
            <span class="d-inline-block text-grey-d2">
                    {!! __('Mostrando') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('-') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('de') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('resultados') !!}
            </span>
        </div>

        <div class="btn-group align-self-center align-self-sm-start pt-3">
            <ul class="pagination">

                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a class="page-link" aria-hidden="true">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </li>
                @endif


                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a class="page-link" href="#">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

@else
    <div class="d-flex flex-column flex-md-row justify-content-between pb-3">
        <div class="text-nowrap align-self-center align-self-sm-start  pt-3">
            <span class="d-inline-block text-grey-d2">
                    {!! __('Mostrando') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('-') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('de') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('resultados') !!}
            </span>
        </div>

    </div>
@endif
