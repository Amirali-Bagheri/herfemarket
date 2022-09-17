@if ($sortField !== $field)
    <i class="text-muted far fa-sort"></i>
@elseif ($sortAsc)
    <i class="far fa-sort-up"></i>
@else
    <i class="far fa-sort-down"></i>
@endif
