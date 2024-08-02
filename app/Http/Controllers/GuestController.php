<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('guest.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('guest.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data =  $request->validate([
            'guest_name' => 'required|unique:guests',
            'total_rooms' => 'required|integer'
        ]);

    // $data = [
    //      'guest_name' => $request->guest_name,
    //      'total_rooms' => $request->total_rooms,
    // ];
        
        $createGuest = Guest::create($data);

        if($createGuest){
            return response()->json(['status'=> true,'id' => $createGuest->id]);
        }else{
            return redirect()->route('guest.create')->with('error','Data not saved');
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
