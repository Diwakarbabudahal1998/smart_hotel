<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;

class ExtraController extends ApiBaseController
{
 //store extra
 public function store(Request $request)
 {

  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'extra_name'  => 'required',
   'extra_price' => 'required',
  ]);
  try {
   //code...
   $extra              = new Extra();
   $extra->user_id     = $user->id;
   $extra->extra_name  = $request->extra_name;
   $extra->extra_price = $request->extra_price;
   if ($extra->save()) {
    return $this->successResponse('Extra Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add Extra');
   }
  } catch (\Exception $e) {
   return $this->errorData( 'Internal Server Error. Failed to add Extra',$e);
  }

 }
 public function update(Request $request)
 {
  $this->validate($request, [
   'extra_name'  => 'required',
   'extra_price' => 'required',
  ]);
  try {
   //code...
   $extra              = Extra::find($request->id);
   $extra->extra_name  = $request->extra_name;
   $extra->extra_price = $request->extra_price;
   if ($extra->save()) {
    return $this->successResponse('Extra Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update Extra');
   }
  } catch (\Exception $e) {
   return $this->errorData($e, 'Internal Server Error. Failed to Update Extra',$e);
  }

 }
 public function viewAll()
 {
  try {
   //code...
   $extra = Extra::where('user_id', auth()->guard('api')->user()->id)->get();
   $data=['extra'=>$extra];
   return $this->successData('Success',$data);
  } catch (\Exception $e) {
    return $this->errorData('Internal Server Error. Failed to view Extra',$e);
  }
 }
 public function delete(Request $request)
 {
  try {
   //code...
   $extra = Extra::find($request->id);
   if($extra->delete()){
    return $this->successResponse('Extra delete Successfully');
   }else{
    return $this->errorResponse('Extra does not exist');
   }
  } catch (\Exception $e) {
    return $this->errorData('Internal Server Error. Failed to delete Extra',$e);
  }
 }
 public function deleteMass(Request $request)
    {
        try {
            $ids = ($request->extra_id);
            Extra::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted Extra");
        } catch (\Exception $e) {
            return $this->errorData("failed to delete Extra",$e);
        }
    }
}