<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filters\Shared\OrderByFilter;
use App\Filters\Shared\SearchByFilter;
use Illuminate\Database\Eloquent\Builder;

class Interviews extends Model
{
    use HasFactory;
    protected $table = "interviews";
    protected $hidden = [
        "id",
        "scp_id"
    ];
    protected $fillable = [
        "scp_id",
        "interview",
        "ocurred_on"
    ];
    public $timestamps = false;

    public $filters = [];

    public function __construct()
    {
        $this->filters = [
            'searchBy' => new SearchByFilter(),
            'orderBy' => new OrderByFilter(),
        ];
    }

    public function scopeFilter(Builder $query, $filters): Builder
    {
        foreach($filters as $key => $value){
            if(array_key_exists($key, $this->filters)){
                $filterClass = $this->filters[$key];
                
                $filter = new $filterClass;

                $query = $filter->handle($query, $value);
            }
        }

        return $query;
    }
}
