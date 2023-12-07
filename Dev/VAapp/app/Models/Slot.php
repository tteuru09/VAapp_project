<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'full'
    ];

    public function get_left_places()
    {
        $total_place = 0;
        $slot_canoes = SlotCanoe::where('ref_slot', $this->id)->get();
        foreach ($slot_canoes as $slot_canoe) 
            $total_place += Canoe::find($slot_canoe->ref_canoe)->numberOfPlace;
            
        return $total_place - count(SlotRower::
        where('ref_slot', $this->id)
        ->where('reserved', 1)->get()->toArray());
    }

    public function get_slot_rower(){
        return SlotRower::where('ref_slot', $this->id)
        ->where('ref_rower', auth()->user()->id)->first();
    }

    public function get_slot_canoes()
    {
        return SlotCanoe::where('ref_slot',$this->id)->get();
    }
}
