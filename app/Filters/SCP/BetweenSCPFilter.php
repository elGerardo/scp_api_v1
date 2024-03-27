<?php

namespace App\Filters\SCP;

use Exception;
use Illuminate\Database\Eloquent\Builder;

class BetweenSCPFilter {
    public function handle(Builder $query, $value){
        try{
            return $query->whereBetween('id', json_decode($value, true));
        }catch(Exception $_){
            return $query;
        }
    }
}