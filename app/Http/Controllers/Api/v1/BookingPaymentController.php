<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingPayment;
use App\Models\Accounting;
use App\Models\Booking;

class BookingPaymentController extends ApiBaseController
{
    public function addPayment(Request $request){
        $this->validate($request,[
            'booking_id'=>'required',
            'amount_paid'=>'required',
            'payment_method'=>'required'
        ]);
        try{
            $payment=new BookingPayment();
            $payment->user_id=auth()->guard('api')->user()->id;
            $payment->booking_id=$request->booking_id;
            $payment->amount_paid=$request->amount_paid;
            $payment->payment_method=$request->payment_method;
    
            //Accounting
            $accounting=Accounting::where('user_id', auth()->guard('api')->user()->id)->first();
            if($request->payment_method=='cash'){
                $accounting->cash_in_hand=$accounting->cash_in_hand + $request->amount_paid;
            }
            elseif($request->payment_method=='bank'){
                $accounting->cash_in_bank=$accounting->cash_in_bank + $request->amount_paid;

            }
            $accounting->save();
            //Accounting Ended

            if($payment->save()){
                $bookng=Booking::find($request->booking_id);
                $paid_amount=BookingPayment::where('booking_id',$request->booking_id)->where('user_id',auth()->guard('api')->user()->id)->sum('amount_paid');
                
                if($bookng->total_amount==$paid_amount){
                    $bookng->payment_status='paid';
                }
                else{
                    $bookng->payment_status='partially_paid';
                }
                $bookng->save();
                $booking=Booking::with('room')->with('guest')->with('payments')->find($request->booking_id);
                $data=['boooking'=>$booking];
                return $this->successData("Payment Added Successfully",$data);
            }       
            else{
                return $this->errorResponse("Unable to add Payment");
            }
        }catch(\Exception $e){
            return $e;
            return $this->errorData('Internal Server Error. Failed to add Payment', $e);
        }
    }
}
