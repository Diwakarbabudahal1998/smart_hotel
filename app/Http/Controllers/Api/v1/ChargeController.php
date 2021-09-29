<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeController extends ApiBaseController
{

 //store Charge
 public function store(Request $request)
 {

  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'charge_name'   => 'required',
   'charge_amount' => 'required',
  ]);
  try {
   //code...
   $charge                = new Charge();
   $charge->user_id       = $user->id;
   $charge->charge_name   = $request->charge_name;
   $charge->charge_amount = $request->charge_amount;
   $charge->charge_status = $request->charge_status;
   if ($charge->save()) {
    return $this->successResponse('charge Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add charge');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add charge', $e);
  }

 }
 //update charge
 public function update(Request $request)
 {
  $this->validate($request, [
   'charge_name'   => 'required',
   'charge_amount' => 'required',
  ]);
  try {
   //code...
   $charge                = Charge::find($request->id);
   $charge->charge_name   = $request->charge_name;
   $charge->charge_amount = $request->charge_amount;
   $charge->charge_status = $request->charge_status;
   if ($charge->save()) {
    return $this->successResponse('charge Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update charge');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to Update Extra', $e);
  }

 }
 //view all charge
 public function viewAll()
 {
  try {
   //code...
   $charge = Charge::where('user_id', auth()->guard('api')->user()->id)->get();
   $data   = ['charge' => $charge];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to view charge', $e);
  }
 }
 //single charge delete
 public function delete(Request $request)
 {
  try {
   //code...
   $charge = Charge::find($request->id);
   if ($charge->delete()) {
    return $this->successResponse('charge delete Successfully');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to delete charge', $e);
  }
 }
 //mass charge delete
 public function deleteMass(Request $request)
 {
  try {
   $ids = json_decode($request->charge_id);
   Charge::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted charge");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete charge", $e);
  }
 }
}