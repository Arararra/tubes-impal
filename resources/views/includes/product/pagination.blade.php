<ul class="pagination">
  <li class="{{ $currentPage == 1 ? 'disabled' : '' }}">
    <a href="{{ $currentPage == 1 ? 'javascript:void(0)' : url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['page' => $currentPage-1])) }}">
      <i class="fa fa-caret-left"></i>
    </a>
  </li>

  @for ($i = 1; $i <= $lastPage; $i++)
    <li class="{{ $currentPage == $i ? 'active' : '' }}">
      <a href="{{ $currentPage == $i ? 'javascript:void(0)' : url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['page' => $i])) }}">
        {{ $i }}
      </a>
    </li>
  @endfor

  <li class="{{ $currentPage == $lastPage ? 'disabled' : '' }}">
    <a href="{{ $currentPage == $lastPage ? 'javascript:void(0)' : url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['page' => $currentPage+1])) }}">
      <i class="fa fa-caret-right"></i>
    </a>
  </li>
</ul>