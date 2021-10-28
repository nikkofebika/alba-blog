@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination pagination-circle pg-blue justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a href="#" class="page-link">First</a></li>
        <li class="page-item disabled">
            <a href="#" class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @else
        <li class="page-item"><a href="{{ \Request::url() }}" class="page-link">First</a></li>
        <li class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        <li class="page-item"><a href="{{ \Request::url().'?page='.$paginator->lastPage() }}" class="page-link">Last</a></li>
        @else
        <li class="page-item disabled">
            <a class="page-link" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        <li class="page-item disabled"><a class="page-link">Last</a></li>
        @endif
    </ul>
</nav>
@endif