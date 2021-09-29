<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends ApiBaseController
{
 //create addons
 public function store(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'addon_name'   => 'required',
   'addon_amount' => 'required',
  ]);
  try {
   //code...
   $addon               = new Addon();
   $addon->addon_name   = $request->addon_name;
   $addon->user_id      = $user->id;
   $addon->addon_amount = $request->addon_amount;
   if (isset($request->addon_description)) {
    $addon->addon_description = $request->addon_description;
   }
   if ($addon->save()) {
    return $this->successResponse('Addon Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add Addon');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add Addon', $e);
  }
 }
 //update addons
 public function update(Request $request)
 {
  $this->validate($request, [
   'addon_name'   => 'required',
   'addon_amount' => 'required',
  ]);
  try {
   //code...
   $addon               = Addon::find($request->id);
   $addon->addon_name   = $request->addon_name;
   $addon->addon_amount = $request->addon_amount;
   if (isset($request->addon_description)) {
    $addon->addon_description = $request->addon_description;
   }
   if ($addon->save()) {
    return $this->successResponse('Addon Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update Addon');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add Addon', $e);
  }
 }
 //view all addon
 public function viewAll()
 {
  try {
   //code...
   $addon = Addon::where('user_id', auth()->guard('api')->user()->id)->get();;
   $data  = ['addon' => $addon];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to view Addon', $e);
  }
 }
 //single addon delete
 public function delete(Request $request)
 {
  try {
   //code...
   $addon = Addon::find($request->id);
   if ($addon->delete()) {
    return $this->successResponse('Addon delete Successfully');
   } else {
    return $this->errorResponse('Addon does not exist');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to delete Addon', $e);
  }
 }
 //mass addon delete
 public function deleteMass(Request $request)
 {
  try {
   $ids = json_decode($request->addon_id);
   Addon::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted Addon");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete Addon", $e);
  }
 }
}