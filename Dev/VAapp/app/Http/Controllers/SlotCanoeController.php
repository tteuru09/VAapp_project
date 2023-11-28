<?php

namespace App\Http\Controllers;

use App\Models\SlotCanoe;
use Illuminate\Http\Request;

class SlotCanoeController extends Controller
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
    public function create($idSlot, $idCanoe)
    {
        SlotCanoe::create([
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SlotCanoe $slotCanoe)
    {
        //
    }


    public function getCanoes($id_slot)
    {
        return SlotCanoe::where('ref_slot', $id_slot);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SlotCanoe $slotCanoe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SlotCanoe $slotCanoe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlotCanoe $slotCanoe)
    {
        //
    }
}
