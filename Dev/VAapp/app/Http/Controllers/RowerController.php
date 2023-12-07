<?php

namespace App\Http\Controllers;

use App\Models\Rower;
use App\Models\SlotRower;
use App\Models\SlotCanoe;
use App\Models\Canoe;
use App\Models\Slot;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class RowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rower.dashboard');
    }

    public function show_slot()
    {
        $not_reserved = 
        SlotRower::
        where('ref_rower',auth()->user()->id)
        ->where('reserved', 0)->pluck('ref_slot')->toArray();
        
        $available_slots_rower = 
        Slot::findOrFail($not_reserved)->where('full', 0);

        
        $reserved = 
        SlotRower::
        where('ref_rower',auth()->user()->id)
        ->where('reserved', 1)->pluck('ref_slot')->toArray(); 
        
        $reserved_slots_rower = 
        Slot::findOrFail($reserved);

        return view('rower.slot', [
            'availableSlots' => $available_slots_rower,
            'reservedSlots' => $reserved_slots_rower,
        ]);
    }

    public function reserve_place(Request $request): RedirectResponse
    {
        $request->validate([
            'slot_id' => 'required',
            'choosenPlace' => 'required'
        ]);
        
        $slot = Slot::find($request->slot_id);

        $slot->get_slot_rower()->update([
            'reserved' => 1
        ]);

        Place::find($request->choosenPlace)->update([
            'rower_id' => auth()->user()->id
        ]);

        if($slot->get_left_places() == 0) $slot->update([
            'full' => 1
        ]);

        return redirect('slot.rower');
    }



    
}
