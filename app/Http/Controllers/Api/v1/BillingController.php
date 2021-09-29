<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends ApiBaseController
{
 //create Billing
 public function store(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'company_name'       => 'required',
   'user_name'          => 'required',
   'price'              => 'required',
   'email'              => 'required',
   'contact'            => 'required',
   'address'            => 'required',
   'product_name'       => 'required',
   'subscription_type'  => 'required',
   'subscriptions_days' => 'required',
  ]);
  try {
   //code...
   $billing                     = new Billing();
   $billing->company_name       = $request->company_name;
   $billing->user_id            = $user->id;
   $billing->user_name          = $request->user_name;
   $billing->price              = $request->price;
   $billing->email              = $request->email;
   $billing->contact            = $request->contact;
   $billing->address            = $request->address;
   $billing->product_name       = $request->product_name;
   $billing->subscription_type  = $request->subscription_type;
   $billing->subscriptions_days = $request->subscriptions_days;
   if ($billing->save()) {
    return $this->successResponse('billing Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add billing');
   }

  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to add billing', $e);
  }
 }
 //Update Billing
 public function update(Request $request)
 {
  $this->validate($request, [
   'company_name'       => 'required',
   'user_name'          => 'required',
   'price'              => 'required',
   'email'              => 'required',
   'contact'            => 'required',
   'address'            => 'required',
   'product_name'       => 'required',
   'subscription_type'  => 'required',
   'subscriptions_days' => 'required',
  ]);
  try {
   //code...
   $billing                     = Billing::find($request->id);
   $billing->company_name       = $request->company_name;
   $billing->user_name          = $request->user_name;
   $billing->price              = $request->price;
   $billing->email              = $request->email;
   $billing->contact            = $request->contact;
   $billing->address            = $request->address;
   $billing->product_name       = $request->product_name;
   $billing->subscription_type  = $request->subscription_type;
   $billing->subscriptions_days = $request->subscriptions_days;
   if ($billing->save()) {
    return $this->successResponse('billing Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update billing');
   }

  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to Update billing', $e);
  }
 }
 //view all
 public function viewAll()
 {
  try {
   //code...
   $billing = Billing::where('user_id', auth()->guard('api')->user()->id)->get();
   $data    = ['billing' => $billing];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view billing', $e);
  }
 }
 //single view
 public function singleView(Request $request)
 {
  try {
   //code...
   $billing = Billing::find($request->id);
   $data    = ['billing' => $billing];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view billing', $e);
  }
 }
}