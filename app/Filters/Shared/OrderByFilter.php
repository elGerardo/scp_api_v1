<?php

namespace App\Filters\Shared;

use Illuminate\Database\Eloquent\Builder;

class OrderByFilter
{
    public function handle(Builder $query, $value)
    {
        if (json_validate($value)) {
            $filter = json_decode($value, true);
            if(!array_key_exists('field', $filter) or !array_key_exists('order', $filter)) return $query;
            return $query->orderBy($filter['field'], $filter['order']);
        }
        return $query;
    }
}
