<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function show_users()
    {
        return view('admin.users', [
            "users" => User::all()
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'max:25'],
            'last_name' => ['required', 'max:25'],
            'email' => ['required'],
            'phone' => ['required'],
            'status' => ['required'],
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required'],
        ]);

        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => $request['status'],
            'phone_number' => $request['phone'],

        ]);
        
        return redirect('users.admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required'],
            'first_name_edit' => ['required', 'max:25'],
            'last_name_edit' => ['required', 'max:25'],
            'email_edit' => ['required'],
            'phone_edit' => ['required'],
        ]);

        User::find($request->user_id)->update([
            'first_name' => $request->first_name_edit,
            'last_name' => $request->last_name_edit,
            'email' => $request->email_edit,
            'phone_number' => $request->phone_edit,
        ]);

        return redirect('users.admin');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required']
        ]);

        User::find(intval($request->user_id))->delete();

        return redirect('users.admin');
    }
}
