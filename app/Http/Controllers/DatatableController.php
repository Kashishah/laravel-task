<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Room_booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatatableController extends Controller
{
    public function getData(Guest $guest, Room_booking $room_booking)
{
    // Retrieve all guests (or use a specific query if needed)
    $guests = $guest->all();

    // Initialize an array to hold the results for all guests
    $allItems = [];

    foreach ($guests as $user) {
        // Retrieve room booking data for the specific user
        $data = $room_booking->where('user_id', $user->id)->get();

        // Initialize the items array with dates and default values of 0
        $datesFromTable = DB::table('date')->pluck('count', 'dates')->toArray();

        // Initialize array to hold all dates
        $items = [];
        foreach ($datesFromTable as $date => $value) {
            $items[$date] = $value;
        }

        // Process each booking to update the items array
        foreach ($data as $booking) {
            $datesBetween = $this->getDatesBetween($booking->start_date, $booking->end_date);
            foreach ($datesBetween as $date) {
                if (isset($items[$date])) {
                    $items[$date]++;
                } else {
                    $items[$date] = 1;
                }
            }
        }

        // Store the results for the current user
        $allItems[$user->id] = [
            'userName' => $user->guest_name,
            'items' => $items
        ];
    }

    // dd($allItems);

    return view('getData.index', [
        'allItems' => $allItems
    ]);
}

private function getDatesBetween($startDate, $endDate)
{
    $dates = [];
    $currentDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    while ($currentDate <= $endDate) {
        $dates[] = date('Y-m-d', $currentDate);
        $currentDate = strtotime('+1 day', $currentDate);
    }

    return $dates;
}

}
