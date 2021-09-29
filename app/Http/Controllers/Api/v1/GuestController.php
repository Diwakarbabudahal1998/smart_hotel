<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends ApiBaseController
{
 public function getGuests()
 {
  try {
   $guests = Guest::where('user_id', auth()->guard('api')->user()->id)->get();
   //return $guests;
   $data = ['guests' => $guests];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error! Failed to get Guests', $e);
  }
 }

 public function store(Request $request)
 {
  $this->validate($request, [
   'name'         => 'required',
   'age'          => 'required',
   'gender'       => 'required',
   'phone_no'     => 'required',
   'email'        => 'required | email',
   'address'      => 'required',
   'country'      => 'required',
   'booking_type' => 'required',

        ]);
        try{
            $guest=new Guest();
            $guest->user_id=auth()->guard('api')->user()->id;
            $guest->name=$request->name;
            $guest->age=$request->age;
            $guest->gender=$request->gender;
            $guest->phone_no=$request->phone_no;
            $guest->email=$request->email;
            $guest->total_stay=$request->total_stay;
            $guest->last_stay=$request->last_stay;
            $guest->total_value=$request->total_value;
            $guest->address=$request->address;
            $guest->country=$request->country;
            $guest->booking_type=$request->booking_type;
            $guest->note=$request->note;

   if ($guest->save()) {
    return $this->successResponse('Guest Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add Guest');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add Guest', $e);
  }
 }

 public function update(Request $request)
 {
  $this->validate($request, [
   'name'         => 'required',
   'age'          => 'required',
   'gender'       => 'required',
   'phone_no'     => 'required',
   'email'        => 'required | email',
   'address'      => 'required',
   'country'      => 'required',
   'booking_type' => 'required',

        ]);
        try{
            $guest=Guest::find($request->id);
            $guest->name=$request->name;
            $guest->age=$request->age;
            $guest->gender=$request->gender;
            $guest->phone_no=$request->phone_no;
            $guest->email=$request->email;
            $guest->total_stay=$request->total_stay;
            $guest->last_stay=$request->last_stay;
            $guest->total_value=$request->total_value;
            $guest->address=$request->address;
            $guest->country=$request->country;
            $guest->booking_type=$request->booking_type;
            $guest->note=$request->note;

   if ($guest->save()) {
    return $this->successResponse('Guest Updated Successfully');
   } else {
    return $this->errorResponse('Guest does not Exists. Unable to Update Guest');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to Update Guest', $e);
  }
 }

 public function destroy($id)
 {
  try {
   $guest = Guest::find($id);
   if ($guest->delete()) {
    return $this->successResponse("Guest Deleted Successfuly");
   } else {
    return $this->errorResponse("Guest does not Exists");
   }
  } catch (\Exception $e) {
   return $this->errorData("Unable to delete Guest", $e);
  }
 }

 public function getSingleGuestDetail($id)
 {
  try {
   $guest = Guest::find($id);
   $data  = ['guest' => $guest];
   return $this->successData("Success", $data);
  } catch (\Exception $e) {
   return $this->errorData("Unable to delete Guest", $e);
  }
 }

    public function deleteMass(Request $request)
    {
        try {
            $ids = ($request->ids);
            Guest::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted selected Guest");
        } catch (\Exception $e) {
            return $this->errorData("Internal Server Error! Failed to delete Guest.",$e);
        }
    }

    public function filter(Request $request){
        try{
            if(isset($request->date_from) && isset($request->date_to) && isset($request->status)){
                $guests=Guest::where('user_id',auth()->guard('api')->user()->id)->where('checked_in','>=',$date_from)->where('checked_in','<=',$date_to)->where('status',$request->status)->get();
                $data=['guests'=>$guests];
            }
            elseif(isset($request->date_from) && isset($request->date_to)){
                $guests=Guest::where('user_id',auth()->guard('api')->user()->id)->where('checked_in','>=',$date_from)->where('checked_in','<=',$date_to)->get();
                $data=['guests'=>$guests];
            }
            elseif(isset($request->status)){
                $guests=Guest::where('user_id',auth()->guard('api')->user()->id)->where('status',$status)->get();
                $data=['guests'=>$guests];
            }
            return $this->successData('Success',$data);
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error. Failed to get Guests', $e);
        }
    }
}