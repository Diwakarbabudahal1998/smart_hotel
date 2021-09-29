<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
class BookingController extends ApiBaseController
{
    public function store(Request $request){

        $this->validate($request,[
            'guest_id'=>'required',
            'checked_in'=>'required',
            'checked_out'=>'required',
            'rate'=>'required',
            'total_amount'=>'required',
        ]);
        try{
            $booking= new Booking();
            $booking->user_id=auth()->guard('api')->user()->id;
            $booking->guest_id=$request->guest_id;
            $booking->checked_in=$request->checked_in;
            $booking->checked_out=$request->checked_out;
            $booking->rate=$request->rate;
            $booking->total_amount=$request->total_amount;
            $booking->payment_status='unpaid';
            $booking->total_amount=$request->total_amount;
            if (isset($request->extras)) {
                $booking->extras = json_encode($request->extras);
            }
            $booking->status="booking";
            if($booking->save()){
                foreach($request->rooms as $key => $singleroom){
                    $room=Room::find($singleroom['id']);
                    $room->status='occupied';
                    $room->save();
                    $booking->room()->attach($room);
                }
                return $this->successResponse("Booking Created Successfully");
            }
            else{
                return $this->errorResponse("Unable to create Booking");
            }
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to create Booking', $e);
        }
    }

    public function update(Request $request){

        $this->validate($request,[
            'guest_id'=>'required',
            'checked_in'=>'required',
            'checked_out'=>'required',
            'rate'=>'required',
            'total_amount'=>'required',
        ]);
        try{
            $booking= Booking::find($request->id);
            $booking->user_id=auth()->guard('api')->user()->id;
            $booking->guest_id=$request->guest_id;
            $booking->checked_in=$request->checked_in;
            $booking->checked_out=$request->checked_out;
            $booking->rate=$request->rate;
            $booking->total_amount=$request->total_amount;
            $booking->payment_status='unpaid';
            $booking->total_amount=$request->total_amount;
            if (isset($request->extras)) {
                $booking->extras = json_encode($request->extras);
            }
            $booking->status="booking";
            if($booking->save()){
                foreach($request->rooms as $key => $singleroom){
                    $room=Room::find($singleroom['id']);
                    $room->status='occupied';
                    $room->save();
                    $booking->room()->attach($room);
                }
                return $this->successResponse("Booking Created Successfully");
            }
            else{
                return $this->errorResponse("Unable to create Booking");
            }
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to create Booking', $e);
        }
    }


    public function getSingleBooking($id){
        try{
            $booking= Booking::with('room')->with('guest')->with('payments')->find($id);
            $data=['boookings'=>$booking];
            return $this->successData('Success',$data);
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to get Booking', $e);
        }
    }

    public function getAllBookings(){
        try{
            $booking=Booking::with('room')->with('guest')->with('payments')->where('user_id',auth()->guard('api')->user()->id)->get();
            $data=['boookings'=>$booking];
            return $this->successData('Success',$data);
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to get Bookings', $e);
        }
    }

    public function getAllArrivingBookings(){
        try{
            $booking=Booking::with('room')->with('guest')->with('payments')->where('user_id',auth()->guard('api')->user()->id)->where('checked_in',Carbon::today())->get();
            $data=['boookings'=>$booking];
            return $this->successData('Success',$data);
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to get Bookings', $e);
        }
    }

    public function checked_In($id){
        try{
            $booking=Booking::find($id);
            $booking->status="checkedin";
            $booking->save();
            return $this->successResponse("Successfully Checked In");
        }
        catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to Check In', $e);
        }

    }

    public function checked_Out($id){
        try{
            $booking=Booking::find($id);
            $booking->status="checkedout";
            $booking->save();
            return $this->successResponse("Successfully Checked Out");
        }
        catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to Check Out', $e);
        }

    }

    public function filter(Request $request){
        try{
            if(isset($request->date_from) && isset($request->date_to) && isset($request->status)){
                $booking=Booking::with('room')->with('guest')->with('payments')->where('user_id',auth()->guard('api')->user()->id)->where('checked_in','>=',$date_from)->where('checked_in','<=',$date_to)->where('status',$request->status)->get();
                $data=['boookings'=>$booking];
            }
            elseif(isset($request->date_from) && isset($request->date_to)){
                $booking=Booking::with('room')->with('guest')->with('payments')->where('user_id',auth()->guard('api')->user()->id)->where('checked_in','>=',$date_from)->where('checked_in','<=',$date_to)->get();
                $data=['boookings'=>$booking];
            }
            elseif(isset($request->status)){
                $booking=Booking::with('room')->with('guest')->with('payments')->where('user_id',auth()->guard('api')->user()->id)->where('status',$status)->get();
                $data=['boookings'=>$booking];
            }
            return $this->successData('Success',$data);
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to get Bookings', $e);
        }
    }
}
