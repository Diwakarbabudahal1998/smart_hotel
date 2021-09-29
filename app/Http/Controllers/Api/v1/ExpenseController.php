<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Accounting;
class ExpenseController extends ApiBaseController
{
 //create expenses
 public function store(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'expense_name'   => 'required',
   'expense_amount' => 'required',
   'expense_type'   => 'required',
  ]);
  try {
   //code...
   $expense                 = new Expense();
   $expense->expense_name   = $request->expense_name;
   $expense->user_id        = $user->id;
   $expense->expense_amount = $request->expense_amount;
   $expense->expense_type   = $request->expense_type;

    //Accounting
    $accounting=Accounting::where('user_id', auth()->guard('api')->user()->id)->first();
    if($request->expense_amount=='cash'){
        $accounting->cash_in_hand=$accounting->cash_in_hand + $request->expense_amount;
    }
    elseif($request->expense_amount=='bank'){
        $accounting->cash_in_bank=$accounting->cash_in_bank + $request->expense_amount;

    }
    $accounting->save();
    //Accounting Ended
   if (isset($request->expense_description)) {
    $expense->expense_description = $request->expense_description;
   }
   if ($expense->save()) {
    return $this->successResponse('expense Added Successfully');
   } else {
    return $this->errorResponse('Unable to Add expense');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add expense', $e);
  }
 }
 //update expenses
 public function update(Request $request)
 {
  $this->validate($request, [
   'expense_name'   => 'required',
   'expense_amount' => 'required',
   'expense_type'   => 'required',
  ]);
  try {
   //code...
   $expense                 = Expense::find($request->id);
   $expense->expense_name   = $request->expense_name;

   $expense->expense_type   = $request->expense_type;
   if (isset($request->expense_description)) {
    $expense->expense_description = $request->expense_description;
   }
   if( $expense->expense_amount != $request->expense_amount){
        //Accounting
        $accounting=Accounting::where('user_id', auth()->guard('api')->user()->id)->first();
        if($request->expense_type=='cash'){
            $accounting->cash_in_hand=$accounting->cash_in_hand - $expense->expense_amount;
            $accounting->cash_in_hand=$accounting->cash_in_hand + $request->expense_amount;
        }
        elseif($request->expense_type=='bank'){
            $accounting->cash_in_bank=$accounting->cash_in_bank + $expense->expense_amount;
            $accounting->cash_in_bank=$accounting->cash_in_bank + $request->expense_amount;

        }
        $accounting->save();
        //Accounting Ended
    }
   $expense->expense_amount == $request->expense_amount;


   if ($expense->save()) {
    return $this->successResponse('expense Update Successfully');
   } else {
    return $this->errorResponse('Unable to Update expense');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to add expense', $e);
  }
 }
 //view all expense
 public function viewAll()
 {
  try {
   //code...
   $expense = Expense::where('user_id',auth()->guard('api')->user()->id)->get();
   $data    = ['expense' => $expense];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to view expense', $e);
  }
 }
 //single expense delete
 public function delete(Request $request)
 {
  try {
   //code...
   $expense = Expense::find($request->id);
   if ($expense->delete()) {
    return $this->successResponse('expense delete Successfully');
   } else {
    return $this->errorResponse('expense does not exist');
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to delete expense', $e);
  }
 }
 //mass expense delete
 public function deleteMass(Request $request)
 {
  try {
   $ids = ($request->expense_id);
   Expense::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted expense");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete expense", $e);
  }
 }
}