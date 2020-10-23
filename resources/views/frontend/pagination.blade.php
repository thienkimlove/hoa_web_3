@if ($paginate->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($paginate->currentPage() == 1) ? 'disabled' : '' }}">
            <a  href="{{ $paginate->url(1) }}">&lt;</a>
        </li>
        @for ($i = 1; $i <= $paginate->lastPage(); $i++)
            <li class="{{ ($paginate->currentPage() == $i) ? 'active' : '' }}">
                <a href="{{ $paginate->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginate->currentPage() == $paginate->lastPage()) ? 'disabled' : '' }}">
            <a href="{{ $paginate->url($paginate->currentPage()+1) }}" >&gt;</a>
        </li>
    </ul>
@endif