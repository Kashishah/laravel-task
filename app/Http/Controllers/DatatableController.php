<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Room_booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatatableController extends Controller
{
    //
    public function getData(Guest $guest, Room_booking $room_booking)
    {
        $user =  $guest->find(1);

        $userName = $user->guest_name;

        $data = $room_booking->where('user_id', $user->id)->get();
        $datesFromTable = (DB::table('date')->pluck('count', 'dates'));
        $dates = [];
        foreach($data as $dataa){
            $dates[] = [ $dataa->start_date=>$dataa->end_date];
        }
        
        dd($dates);

        // return view('index',[
        //     'username'=>$userName
        // ]);
    }
}
