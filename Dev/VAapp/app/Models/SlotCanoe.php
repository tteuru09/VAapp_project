<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotCanoe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ref_slot',
        'ref_canoe',
    ];

    public function get_places()
    {
        return Place::where('ref_slot_canoe', $this->id)
        ->orderByDesc('position')
        ->get();
    }

    public function get_canoe_name()
    {
        return Canoe::find($this->ref_canoe)->name;
    }

    public function get_canoe_nbplaces()
    {
        return Canoe::find($this->ref_canoe)->numberOfPlace;
    }
}
