<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
class HomeController extends ApiBaseController
{
    public function getBookingDetails(Request $request){
        $extras=array();
        $details=array();
        $Date = $request->date;
        $init_date= date('Y-m-d', strtotime($Date. ' - 15 days'));
        $end_date= date('Y-m-d', strtotime($Date. ' + 15 days'));
        // $detail=Room::with('booking.guest')->whereHas('booking',function($q) use($init_date,$end_date){
        //     $q->where('bookings.created_at','>=',$init_date);
        //     $q->where('bookings.created_at','<=',$end_date);
        // })
        // ->get();

        $rooms=Room::all();
        foreach($rooms as $key=>$room){
            $booking=Booking::with('guest')->where('user_id',auth()->guard('api')->user()->id)->where('created_at','>=',$init_date)->where('created_at','<=',$end_date)->whereHas('room',function($q) use($room){
                $q->where('room_id',$room->id);
            })->get();
            foreach($booking as $key=>$singlebooking){
                $singlebooking->extras=json_decode($singlebooking->extras);
            }
            $room->bookings=$booking;
            array_push($details,$room);
        }
        $data=['rooms'=>$details];
        return $this->successData('Success',$data);
    }
}
