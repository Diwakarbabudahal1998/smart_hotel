<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Payment;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends ApiBaseController
{
 //
 public function store(Request $request)
 {

  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'payment_name' => 'required',
  ]);
  try {
   //code...
   $payment               = new Payment();
   $payment->user_id      = $user->id;
   $payment->payment_name = $request->payment_name;
   if ($image = $request->file('image')) {
    $filename   = time() . '.' . $image->getClientOriginalExtension();
    $folderpath = 'public/payment/';
    Storage::putFileAs('public/payment/' . $user->id, new File($image), $filename);
    $payment->image = $filename;
   } else {
    return $this->errorResponse('Unable to Add payment');
   }
   if ($payment->save()) {
    return $this->successResponse('payment Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add payment');
   }

  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to add payment', $e);
  }

 }

 //Update payment information
 public function update(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'payment_name' => 'required',
  ]);
  try {
   //code...
   $payment               = Payment::find($request->id);
   $payment->payment_name = $request->payment_name;
   if ($payment->image != null) {
    Storage::delete('public/payment/' . $user->id . '/' . $payment->image);
   }
   if ($image = $request->file('image')) {;
    $filename   = time() . '.' . $image->getClientOriginalExtension();
    $folderpath = 'public/payment/';
    Storage::putFileAs('public/payment/' . $user->id, new File($image), $filename);
    $payment->image = $filename;
   } else {
    return $this->errorResponse('Unable to Update payment');
   }
   if ($payment->save()) {
    return $this->successResponse('payment Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update payment');
   }

  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to Update payment', $e);
  }

 }
 // view All Payment
 public function viewAll()
 {
  $user = auth()->guard('api')->user();
  try {
   $payment = Payment::where('user_id', $user->id)->get();
   //return $payment;
   foreach ($payment as $key => $pay) {
    $pay->image = asset('storage/payment/' . $user->id . '/' . $pay->image);
   }
   $data = ['payment' => $payment];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to view payment', $e);
  }
 }
 // singleView Payment
 public function singleView(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   $payment        = Payment::find($request->id);
   $payment->image = asset('storage/payment/' . $user->id . '/' . $payment->image);
   $data           = ['payment' => $payment];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $e;
   return $this->errorData('Internal Server Error. Failed to view payment', $e);
  }
 }
 //single delete
 public function delete(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   //code...
   $payment = Payment::find($request->id);
   if ($payment->image != null) {
    Storage::delete('public/payment/' . $user->id . '/' . $payment->image);
   }
   if ($payment->delete()) {
    return $this->successResponse('payment delete Successfully');
   } else {
    return $this->errorResponse("payment does not Exists");
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to delete payment', $e);
  }
 }
 //mass payment delete
 public function deleteMass(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   $ids     = ($request->payment_id);
   $payment = Payment::whereIn('id', $ids)->get();
   foreach ($payment as $key => $pay) {
    $pay->image = Storage::delete('public/payment/' . $user->id . '/' . $pay->image);
   }
   Payment::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted payment");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete payment", $e);
  }
 }
}