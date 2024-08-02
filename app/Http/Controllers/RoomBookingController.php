<?php

namespace App\Http\Controllers;

use App\Models\Room_booking;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
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
    public function store(Request $request)
    {
        $name_of_guest = $request->name_of_guest;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $datalength =count($name_of_guest);
     



        $data = [];
        // $date= [];


        for($i=0; $i < $datalength; $i++){
            $data[] = [
                'user_id'=>$request->guest_id,
                'name'=>(string)$name_of_guest[$i],
                'start_date'=>(string)$start_date[$i],
                'end_date'=>(string)$end_date[$i]
            ];
            // $date[$start_date[$i]] = $end_date[$i];
        }


        // foreach($date as $key => $val){
        //    $start =  date($key); 
        //    $end =  date($val); 

        //    echo $start ."==> ". $end ."<br>";

        // }
        // die;
       
        
       $room_booking =  Room_booking::insert($data);

        if($room_booking){
            return response()->json(['status'=> true]);
        }else{
            return redirect()->route('guest.create')->with('error','Data not saved');
        }
       

       
    }

    /**
     * Display the specified resource.
     */
    public function show(Room_booking $room_booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room_booking $room_booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room_booking $room_booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room_booking $room_booking)
    {
        //
    }
}
