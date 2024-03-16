<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
