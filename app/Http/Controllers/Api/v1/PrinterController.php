<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Printer;
use Illuminate\Http\Request;

class PrinterController extends ApiBaseController
{
 //store printer
 public function store(Request $request)
 {

  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'bill_header'  => 'required',
   'bill_footer'  => 'required',
   'printer_size' => 'required',
   'status'       => 'required',
  ]);
  try {
   //code...
   $printer          = new Printer();
   $printer->user_id = $request->user_id;
   $existing         = Printer::where('user_id', $request->user_id)->first();
   if (isset($existing)) {
    return $this->errorData("Printer already in use", 500);

   }
   $printer->user_id      = $user->id;
   $printer->bill_header  = $request->bill_header;
   $printer->bill_footer  = $request->bill_footer;
   $printer->printer_size = $request->printer_size;
   $printer->printer_name = $request->printer_name;
   $printer->status       = $request->status;
   if ($printer->save()) {
    return $this->successResponse('Printer Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add Printer');
   }
  } catch (\Exception $e) {
   return $this->errorData($e, 'Internal Server Error. Failed to add Printer');
  }

 }
 //update Printer
 public function update(Request $request)
 {
  $this->validate($request, [
   'bill_header'  => 'required',
   'bill_footer'  => 'required',
   'printer_size' => 'required',
   'status'       => 'required',
  ]);
  try {
   //code...
   $printer               = Printer::find($request->id);
   $printer->bill_header  = $request->bill_header;
   $printer->bill_footer  = $request->bill_footer;
   $printer->printer_size = $request->printer_size;
   $printer->printer_name = $request->printer_name;
   $printer->status       = $request->status;
   if ($printer->save()) {
    return $this->successResponse('Printer Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update Printer');
   }
  } catch (\Exception $e) {
   return $this->errorData($e, 'Internal Server Error. Failed to Update Printer');
  }

 }
 //single view Printer
 public function singleView(Request $request)
 {
  try {
   //code...
   $printer = Printer::find($request->id);
   $data    = ['printer' => $printer];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view printer', $e);
  }
 }
 //view all printer
 public function viewAll()
 {
  try {
   //code...
   $printer = Printer::where('user_id', auth()->guard('api')->user()->id)->first();
   $data    = ['printer' => $printer];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to view printer', $e);
  }
 }
}