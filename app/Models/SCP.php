<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
