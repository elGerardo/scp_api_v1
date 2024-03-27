<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filters\Shared\OrderByFilter;
use App\Filters\Shared\SearchByFilter;

class Category extends Model
{
    use HasFactory;
    protected $table = "category";
    protected $hidden = [
        "id"
    ];
    protected $fillable = [
        "name",
        "description",
        "picture"
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
                $query = $filterClass->handle($query, $value);
            }
        }

        return $query;
    }
}
