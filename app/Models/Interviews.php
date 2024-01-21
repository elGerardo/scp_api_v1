<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviews extends Model
{
    use HasFactory;
    protected $table = "interviews";
    protected $hidden = [
        "id"
    ];
    protected $fillable = [
        "scp_id",
        "interview"
    ];
    public $timestamps = false;
}
