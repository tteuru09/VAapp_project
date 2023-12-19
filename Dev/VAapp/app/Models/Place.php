<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'ref_slot_canoe',
        'rower_id'
    ];

    public function get_rower()
    {
        return User::find($this->rower_id);
    }
}
