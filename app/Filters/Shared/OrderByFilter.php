<?php 

namespace App\Filters\Shared;

use Exception;
use Illuminate\Database\Eloquent\Builder;

class OrderByFilter {
    public function handle(Builder $query, $value){
        try{
            $filter = json_decode($value, true);
            return $query->orderBy($filter['field'], $filter['order']);
        }catch(Exception $_){
            return $query;
        }
    }
}