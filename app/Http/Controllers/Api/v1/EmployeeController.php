<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends ApiBaseController
{
 // Create Employee
 public function store(Request $request)
 {
  $user = auth()->guard('api')->user();
  $this->validate($request, [
   'employee_name'     => 'required',
   'employee_contact'  => 'required',
   'employee_email'    => 'required',
   'employee_address'  => 'required',
   'employee_id_no'    => 'required',
   'employee_id_type'  => 'required',
   'employee_position' => 'required',
  ]);
  try {
   //code...
   $employee                    = new Employee();
   $employee->user_id           = $user->id;
   $employee->employee_name     = $request->employee_name;
   $employee->employee_contact  = $request->employee_contact;
   $employee->employee_address  = $request->employee_address;
   $employee->employee_email    = $request->employee_email;
   $employee->employee_id_type  = $request->employee_id_type;
   $employee->employee_id_no    = $request->employee_id_no;
   $employee->employee_position = $request->employee_position;
   if ($employee->save()) {
    return $this->successResponse('Employee added successfully');
   } else {
    return $this->errorResponse('Unable to add employee');
   }
  } catch (\Exception $e) {
   //Exception $e;
   return $this->errorData('Internal Server Error. Failed to add employee', $e);
  }
 }
 //Update employee
 public function update(Request $request)
 {
  $this->validate($request, [
   'employee_name'     => 'required',
   'employee_contact'  => 'required',
   'employee_email'    => 'required',
   'employee_address'  => 'required',
   'employee_id_no'    => 'required',
   'employee_id_type'  => 'required',
   'employee_position' => 'required',
  ]);
  try {
   $employee                    = Employee::find($request->id);
   $employee->employee_name     = $request->employee_name;
   $employee->employee_contact  = $request->employee_contact;
   $employee->employee_address  = $request->employee_address;
   $employee->employee_email    = $request->employee_email;
   $employee->employee_id_type  = $request->employee_id_type;
   $employee->employee_id_no    = $request->employee_id_no;
   $employee->employee_position = $request->employee_position;
   if ($employee->save()) {
    return $this->successResponse('Employee update successfully');
   } else {
    return $this->errorResponse('Unable to update employee');
   }

  } catch (\Exception $e) {
   //Exception $e;
   return $this->errorData('Internal Server Error. Failed to update employee', $e);
  }
 }
 //view all employees
 public function viewAll()
 {
  try {
   //code...
   $employee = Employee::where('user_id', auth()->guard('api')->user()->id)->get();
   $data     = ['employee' => $employee];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view employee', $e);
  }
 }
 //single view employee
 public function singleView(Request $request)
 {
  try {
   //code...
   $employee = Employee::find($request->id);
   $data     = ['employee' => $employee];
   return $this->successData('Success', $data);
  } catch (\Exception $e) {
   //throw $th;
   return $this->errorData('Internal Server Error. Failed to view employee', $e);
  }
 }
 //single delete
 public function delete(Request $request)
 {
  try {
   //code...
   $employee = Employee::find($request->id);
   if ($employee->delete()) {
    return $this->successResponse('Employee delete Successfully');
   }else {
    return $this->errorResponse("Employee does not Exists");
   }
  } catch (\Exception $e) {
   return $this->errorData('Internal Server Error. Failed to delete Employee', $e);
  }
 }
 //mass employee delete
 public function deleteMass(Request $request)
 {
  try {
   $ids = ($request->employee_id);
   Employee::whereIn('id', $ids)->delete();
   return $this->successResponse("Successfully deleted Employee");
  } catch (\Exception $e) {
   return $this->errorData("failed to delete Employee", $e);
  }
 }
}