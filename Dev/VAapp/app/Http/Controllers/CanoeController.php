<?php

namespace App\Http\Controllers;

use App\Models\Canoe;
use App\Models\SlotCanoe;
use App\Models\SlotRower;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CanoeController extends Controller
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
            'vaa_name' => ['required','max:10'],
            'numberOfPlace' => ['required'],
        ]);

        Canoe::create([
            'name' => $request->vaa_name,
            'numberOfPlace' => intval($request->numberOfPlace)
        ]);
        
        return redirect('canoe.trainer');
    }

    /**
     * Display the specified resource.
     */
    public function show(Canoe $canoe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): RedirectResponse
    {
        $request->validate([
            'canoe_id' => ['required','max:10'],
            'vaa_name_edit' => ['required','max:10'],
            'numberOfPlaceEdit' => ['required'],
        ]);

        $actual_canoe = Canoe::find($request->canoe_id);

        if($actual_canoe->name != $request->vaa_name_edit) $actual_canoe->update([
            'name' => $request->vaa_name_edit
        ]);

        return redirect('canoe.trainer');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Canoe $canoe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'canoe_id' => ['required']
        ]);

        $canoe = Canoe::find(intval($request->canoe_id));

        $slots_canoe = SlotCanoe::where('ref_canoe', $canoe->id)->get();

        foreach($slots_canoe as $slot_canoe) {
            $places = Place::where('ref_slot_canoe', $slot_canoe->id)->get();
            foreach($places as $place){
                if($place->rower_id != null) SlotRower::where([
                    ['ref_rower', '=', $place->rower_id],
                    ['ref_slot', '=' ,$slot_canoe->ref_slot]
                ])->update(['reserved' => 0]);
            }
        }

        $canoe->delete();
        return redirect('canoe.trainer');
    }
}
