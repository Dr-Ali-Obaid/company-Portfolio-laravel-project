@if ($paginator->hasPages())
    <nav class="d-flex align-items-center justify-content-between" role="navigation">
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            {{-- الجزء الخاص بمعلومات عدد النتائج (مترجم ديناميكياً) --}}
            <div>
                <p class="small text-muted">
                    {{ __('Showing') }}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {{ __('to') }}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {{ __('of') }}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {{ __('results') }}
                </p>
            </div>

            {{-- روابط التنقل --}}
            <div>
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="page-link" aria-hidden="true">
                                <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">
                                <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements (الأرقام) --}}
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
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">
                                <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="page-link" aria-hidden="true">
                                <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif