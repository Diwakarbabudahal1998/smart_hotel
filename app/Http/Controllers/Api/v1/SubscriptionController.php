<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends ApiBaseController
{
 //create Subscription
 public function store(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'title'             => 'required',
   'secondary_title'   => 'required',
   'price'             => 'required',
   'subscription_days' => 'required',
   'subscription_type' => 'required',
  ]);
  try {
   //code...
   $subscription                    = new Subscription();
   $subscription->title             = $request->title;
   $subscription->user_id           = $user->id;
   $subscription->secondary_title   = $request->secondary_title;
   $subscription->price             = $request->price;
   $subscription->subscription_days = $request->subscription_days;
   $subscription->subscription_type = $request->subscription_type;
   $subscription->description       = $request->description;
   if ($subscription->save()) {
    return $this->successResponse('Subscription Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add Subscription');
   }

  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to add Subscription', $e);
  }
 }
 //update Subscription
 public function update(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'title'             => 'required',
   'secondary_title'   => 'required',
   'price'             => 'required',
   'subscription_days' => 'required',
   'subscription_days' => 'required',
  ]);
  try {
   //code...
   $subscription                    = Subscription::find($request->id);
   $subscription->title             = $request->title;
   $subscription->secondary_title   = $request->secondary_title;
   $subscription->price             = $request->price;
   $subscription->subscription_days = $request->subscription_days;
   $subscription->subscription_type = $request->subscription_type;
   $subscription->description       = $request->description;
   if ($subscription->save()) {
    return $this->successResponse('Subscription update Successfully');
   } else {
    return $this->errorResponse('Unable to update Subscription');
   }

  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to update Subscription', $e);
  }
 }
 //view all
 public function viewAll()
 {
  try {
   //code...
   $subscription = Subscription::where('user_id', auth()->guard('api')->user()->id)->get();
   $data         = ['subscription' => $subscription];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view Subscription', $e);
  }
 }
 //single view
 public function singleView(Request $request)
 {
  try {
   //code...
   $subscription = Subscription::find($request->id);
   $data         = ['subscription' => $subscription];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view Subscription', $e);
  }
 }
 //single delete
 public function delete(Request $request)
 {
  try {
   //code...
   $subscription = Subscription::find($request->id);
   if ($subscription->delete()) {
    return $this->successResponse('subscription delete Successfully');
   } else {
    return $this->errorResponse('Subscription does not exist');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to delete Subscription', $e);
  }
 }
 //mass delete
 public function deleteMass(Request $request)
 {
  try {
   $ids = ($request->subscription_id);
   Subscription::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted Subscription");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete Subscription", $e);
  }
 }
}