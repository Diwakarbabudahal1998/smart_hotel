<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends ApiBaseController
{
 //store discount
 public function store(Request $request)
 {

  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'discount_name'   => 'required',
   'discount_amount' => 'required',
  ]);
  try {
   //code...
   $discount                  = new Discount();
   $discount->user_id         = $user->id;
   $discount->discount_name   = $request->discount_name;
   $discount->discount_amount = $request->discount_amount;
   $discount->discount_type   = $request->discount_type;
   if ($discount->save()) {
    return $this->successResponse('discount Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add discount');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add discount',$e);
  }

 }
 //update discount
 public function update(Request $request)
 {
  $this->validate($request, [
   'discount_name'   => 'required',
   'discount_amount' => 'required',
  ]);
  try {
   //code...
   $discount                  = Discount::find($request->id);
   $discount->discount_name   = $request->discount_name;
   $discount->discount_amount = $request->discount_amount;
   $discount->discount_type   = $request->discount_type;
   if ($discount->save()) {
    return $this->successResponse('discount Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update discount');
   }
  } catch (\Exception $e) {
   return $this->errorData($e, 'Internal Server Error. Failed to Update Extra',$e);
  }

 }
 //view all discount
 public function viewAll()
 {
  try {
   //code...
   $discount = Discount::where('user_id', auth()->guard('api')->user()->id)->get();
   $data=['discount'=>$discount];
   return $this->successData('Success',$data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to view discount',$e);
  }
 }
 //single discount delete
 public function delete(Request $request)
 {
  try {
   //code...
   $discount = Discount::find($request->id);
   if ($discount->delete()) {
    return $this->successResponse('discount delete Successfully');
   }else{
    return $this->errorResponse( 'Discount does not exist');
   }
  } catch (\Exception $e) {
   return $this->errorData( 'Internal Server Error. Failed to delete discount',$e);
  }
 }
 //mass discount delete
 public function deleteMass(Request $request)
 {
  try {
   $ids = json_decode($request->discount_id);
   Discount::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted discount");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete discount",$e);
  }
 }
}