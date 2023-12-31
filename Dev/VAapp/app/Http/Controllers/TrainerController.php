<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Slot;
use App\Models\Canoe;
use App\Models\User;
use App\Models\SlotCanoe;
use App\Models\SlotRower;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('trainer.dashboard');
    }


    public function show_slot()
    {
        return view('trainer.slot', [
            'slots' => Slot::all(),
            'canoes' => Canoe::all(),
            'rowers' => User::where('status', 'rower')->get()
        ]);
    }

    public function show_canoe()
    {
        return view('trainer.canoe', [
            'canoes' => Canoe::all()
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        //
    }
}
