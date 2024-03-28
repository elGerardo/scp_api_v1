<?php

namespace App\Filters\SCP;

use Illuminate\Database\Eloquent\Builder;

class BetweenSCPFilter
{
    public function handle(Builder $query, $value)
    {
        if (json_validate($value)) return $query->whereBetween('id', json_decode($value, true));
        return $query;
    }
}
