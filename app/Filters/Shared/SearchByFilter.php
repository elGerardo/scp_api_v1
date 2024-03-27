<?php 

namespace App\Filters\Shared;

use Exception;
use Illuminate\Database\Eloquent\Builder;

class SearchByFilter {
    public function handle(Builder $query, $value){
        try{
            $filter = json_decode($value, true);
            return $query->where($filter['field'], 'LIKE', '%'.$filter['value'].'%'); 
        }catch(Exception $_){
            return $query;
        }
    }
}