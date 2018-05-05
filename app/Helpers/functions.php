<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

function paginateArray($items, $perPage = 6, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    $paginatedItems = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    $paginatedItems->setPath(url()->current());

    return $paginatedItems;
}
