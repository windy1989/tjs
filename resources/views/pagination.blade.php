@if($paginator->hasPages())
    <ul class="mt-3 container justify-content-center pagination pagination-rounded pagination-3d">
        @if($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                    <i class="icon-arrow-left2"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="icon-arrow-left2"></i>
                </a>
            </li>
        @endif

        @foreach($elements as $element)
            @if(is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <a class="page-link" href="javascript:void(0);">{{ $element }}</a>
                </li>
            @endif

            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" syle="border: none !important;" href="javascript:void(0);">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="icon-arrow-right2"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a class="page-link" href="javascript:void(0);" aria-hidden="true">
                    <i class="icon-arrow-right2"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
