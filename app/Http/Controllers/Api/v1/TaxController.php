<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends ApiBaseController
{
 public function getTax()
 {
  try {
   $tax  = Tax::where('user_id', auth()->guard('api')->user()->id)->get();
   $data = ['taxes' => $tax];
   return $this->successData('Success', $tax);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error! Unable to get the taxes.', $e);
  }
 }
 public function store(Request $request)
 {
  $this->validate($request, [
   'tax_name'    => 'required',
   'tax_percent' => 'required',
  ]);
  try {
   $tax              = new Tax();
   $tax->user_id     = auth()->guard('api')->user()->id;
   $tax->tax_name    = $request->tax_name;
   $tax->tax_percent = $request->tax_percent;
   $tax->tax_status  = $request->tax_status;

   if ($tax->save()) {
    return $this->successResponse('Tax Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add Tax');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add Tax', $e);
  }
 }

 public function update(Request $request)
 {
  try {
   $tax              = Tax::find($request->id);
   $tax->user_id     = auth()->guard('api')->user()->id;
   $tax->tax_name    = $request->tax_name;
   $tax->tax_percent = $request->tax_percent;
   $tax->tax_status  = $request->tax_status;
   if ($tax->save()) {
    return $this->successResponse('Tax Updated Successfully');
   } else {
    return $this->errorResponse('Unable to Update Tax');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to Update Tax', $e);
  }

 }
 public function destroy($id)
 {
  try {
   $tax = Tax::find($id);
   if ($tax->delete()) {
    return $this->successResponse("Tax Deleted Successfuly");
   } else {
    return $this->errorResponse("Tax does not Exists");
   }
  } catch (\Exception $e) {
   return $this->errorData("Unable to delete Tax", $e);
  }
 }

 public function deleteMass(Request $request)
 {
  try {
   $ids = ($request->ids);
   if (Tax::whereIn('id', $ids)->delete()) {
    return $this->successResponse("Successfully deleted selected Taxes");
   } else {
    return $this->errorResponse("Unable to delete selected Taxes.");
   }
  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Failed to delete Taxes.", $e);
  }
 }
}