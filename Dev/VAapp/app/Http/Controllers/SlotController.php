<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\SlotCanoe;
use App\Models\SlotRower;
use App\Models\Canoe;
use App\Models\Place;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all_slots()
    {
        return Slot::all();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'date' => ['required', 'date_format:d-m-Y', 'after:yesterday'],
            'timeStart' => ['required', 'date_format:H:i'],
            'timeEnd' => ['required', 'date_format:H:i', 'after:timeStart'],
            'canoes.*' => ['required'],
            'rowers.*' => ['required']
        ]);

        $allValues = $request->all();

        $slot = Slot::create([
            'date' => date_format(date_create($allValues['date']),'Y-m-d'),
            'start_time' => $allValues['timeStart'],
            'end_time' => $allValues['timeEnd'],
            'full' => false
        ]);

        $canoes = $allValues['canoes'];
        $all_canoes = Canoe::all();
        $rowers = $allValues['rowers'];
        $lengthCanoes = count($canoes);
        $lengthRowers = count($rowers);

        for($i = 1; $i < $lengthCanoes; $i++){
            $actual_canoe = $all_canoes->find(intval($canoes[$i]));
            
            SlotCanoe::create([
                'ref_slot' => $slot->id,
                'ref_canoe' => $actual_canoe->id
            ]);
            
            for($x = 1; $x <= $actual_canoe->numberOfPlace; $x++ ){
                Place::create([
                    'position' => $x,
                    'ref_slot' => $slot->id,
                    'ref_canoe' => $actual_canoe->id,
                    'rower_id' => null,
                ]);
            }
        }

        for($j = 1; $j < $lengthRowers; $j++){
            SlotRower::create([
                'ref_rower' => intval($rowers[$j]),
                'ref_slot' => $slot->id,
                'reserved' => false
            ]);
        }
        

        return redirect('slot.trainer');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slot $slot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slot $slot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slot $slot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        //
    }
}
