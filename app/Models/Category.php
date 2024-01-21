<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
