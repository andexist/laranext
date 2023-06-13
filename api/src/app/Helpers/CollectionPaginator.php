<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CollectionPaginator
{
    public static function paginate(Collection $results, int $pageSize)
    {
        $page = Paginator::resolveCurrentPage('page');
        
        $total = $results->count();

        return self::paginator($results->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

    }

    protected static function paginator(
        Collection $items, 
        int $total, 
        int $perPage, 
        int $currentPage, 
        array $options
        ): LengthAwarePaginator 
        {
            return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
                'items', 'total', 'perPage', 'currentPage', 'options'
            ));
        }
}
