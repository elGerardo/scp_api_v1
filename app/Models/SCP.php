<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\SCP\BetweenSCPFilter;
use App\Filters\Shared\OrderByFilter;
use App\Filters\Shared\SearchByFilter;

class SCP extends Model
{
    use HasFactory;
    protected $table = "scp";
    protected $fillable = [
        "id",
        "code",
        "name",
        "weight",
        "height",
        "picture",
        "description",
        "category_id"
    ];
    public $timestamps = false;
    protected $hidden = ["pivot"];
    public $filters = [];

    public function __construct()
    {
        $this->filters = [
            'searchBy' => new SearchByFilter(),
            'between' => new BetweenSCPFilter(),
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

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interviews::class, 'scp_id', 'id');
    }

    public function enemies(): BelongsToMany
    {
        return $this->belongsToMany(SCP::class, 'enemies', 'scp_id', 'scp_enemy_id');
    }
}
