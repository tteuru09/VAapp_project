<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'numberOfPlace'
    ];
}
