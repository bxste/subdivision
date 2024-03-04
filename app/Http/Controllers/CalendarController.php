<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = Booking::all();
        foreach($bookings as $booking){
            $events[] = [
                'id' => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
            ];
        }

        return view('admin.calendar', ['events' => $events]);
    }
    public function user()
    {
        $events = array();
        $bookings = Booking::all();
        foreach($bookings as $booking){
            $events[] = [
                'id' => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
            ];
        }

        return view('dashboard', ['events' => $events]);
    }
    public function store(Request $request){

        $request->validate([
            'title' => 'required|string'
        ]);
        $booking = Booking::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json($booking);
    }
    public function update(Request $request, $id){
        $booking = Booking::find($id);
        if(! $booking){
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event Updated');
    }
    public function destroy($id)
    {
        $booking = Booking::find($id);
        {
            if(! $booking){
                return response()->json([
                    'error' => 'Unable to locate the event'
                ], 404);
            }
            $booking->delete();
            return $id;
        }
    }
}
