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
        $rowers = $allValues['rowers'];
        $lengthCanoes = count($canoes);
        $lengthRowers = count($rowers);

        for($i = 1; $i < $lengthCanoes; $i++){
            $actual_canoe = Canoe::find(intval($canoes[$i]));
            
            $slot_canoe = SlotCanoe::create([
                'ref_slot' => $slot->id,
                'ref_canoe' => $actual_canoe->id
            ]);
            
            for($x = 1; $x <= $actual_canoe->numberOfPlace; $x++ ){
                $actual_place = Place::create([
                    'position' => $x,
                    'ref_slot_canoe' => $slot_canoe->id,
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
    public function edit(Request $request): RedirectResponse
    {
        $request->validate([
            'dateEdit' => ['required', 'date_format:d-m-Y', 'after:yesterday'],
            'timeStartEdit' => ['required', 'date_format:H:i'],
            'timeEndEdit' => ['required', 'date_format:H:i', 'after:timeStart'],
            'canoes.*' => ['required'],
            'rowers.*' => ['required']
        ]);

        //Declarations
        $allValues = $request->all();
        $slot = Slot::find(intval($allValues['slot_id']));
        
        $slot->update([
            'date' => date_format(date_create($allValues['dateEdit']),'Y-m-d'),
            'start_time' => $allValues['timeStartEdit'],
            'end_time' => $allValues['timeEndEdit'],
            'full' => false
        ]);

        $old_slot_canoes = SlotCanoe::where('ref_slot', $slot->id)->pluck('ref_canoe')->toArray();
        $old_slot_rowers = SlotRower::where('ref_slot', $slot->id)->pluck('ref_rower')->toArray();
        
        array_shift($allValues['canoes']);
        array_shift($allValues['rowers']);

        $actual_slot_canoes_id = array_map('intval',$allValues['canoes']);
        $actual_slot_rowers_id = array_map('intval',$allValues['rowers']);

        //Operations


        $instersect_slot_canoes = array_intersect($old_slot_canoes, $actual_slot_canoes_id);
        $instersect_slot_rowers = array_intersect($old_slot_rowers, $actual_slot_rowers_id);

        $to_delete_slot_canoes = array_diff($old_slot_canoes, $instersect_slot_canoes);
        $to_delete_slot_rowers = array_diff($old_slot_rowers, $instersect_slot_rowers);
        
        $to_add_slot_canoes = array_diff($actual_slot_canoes_id, $instersect_slot_canoes);
        $to_add_slot_rowers = array_diff($actual_slot_rowers_id, $instersect_slot_rowers);

        foreach($to_delete_slot_canoes as $slot_canoe) {
            $actual_slot_canoe = SlotCanoe::where([
                ['ref_slot', '=' ,$slot->id],
                ['ref_canoe', '=', $slot_canoe]])->first();

            $places = Place::where('ref_slot_canoe', $actual_slot_canoe->id)->get();
            foreach($places as $place){
                if($place->rower_id != null) SlotRower::where([
                    ['ref_rower', '=', $place->rower_id],
                    ['ref_slot', '=' ,$slot->id]
                ])->update(['reserved' => 0]);
            }
            
            $actual_slot_canoe->delete(); 
        }

        $slot_canoes = SlotCanoe::where('ref_slot', $slot->id)->pluck('id')->toArray();

        foreach($to_delete_slot_rowers as $slot_rower) {
            
            SlotRower::where([
            ['ref_slot', '=' ,$slot->id],
            ['ref_rower', '=', $slot_rower]])
            ->delete();

            foreach($slot_canoes as $slot_canoe){
                $place = Place::where([
                    ['rower_id', '=', $slot_rower],
                    ['ref_slot_canoe', '=' ,$slot_canoe]
                ])->first();

                if($place != null) $place->update([
                    'rower_id' => null
                ]);
            }
        }
        

        foreach($to_add_slot_canoes as $id_canoe) {
            $slot_canoe = SlotCanoe::create([
                'ref_slot' => $slot->id,
                'ref_canoe' => $id_canoe
            ]);
            $actual_canoe = Canoe::find($id_canoe);
            for($x = 1; $x <= $actual_canoe->numberOfPlace; $x++ ){
                Place::create([
                    'position' => $x,
                    'ref_slot_canoe' => $slot_canoe->id,
                ]);
            }
        }

        foreach($to_add_slot_rowers as $slot_rower) {
            SlotRower::create([
                'ref_slot' => $slot->id,
                'ref_rower' => $slot_rower,
                'reserved' => 0
            ]);
        }

        

        return redirect('slot.trainer');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slot $slot)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'slot_id' => ['required']
        ]);

        Slot::find(intval($request->slot_id))->delete();

        return redirect('slot.trainer');
    }
}
