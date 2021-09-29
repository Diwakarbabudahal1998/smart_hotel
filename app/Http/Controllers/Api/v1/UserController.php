<?php

namespace App\Http\Controllers\Api\v1;

use App\Mail\VerificationMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends ApiBaseController
{
 public function register(Request $request)
 {
  $this->validate($request, [
   'name'             => 'required',
   'username'         => 'required',
   'hotel_name'       => 'required',
   'email'            => 'required|email',
   'password'         => 'required',
   'confirm_password' => 'required',
   'phone'            => 'required',
  ]);
  try {
   $user        = new User();
   $user->email = $request->email;
   $existing    = User::where('email', $request->email)->first();
   if (isset($existing)) {
    return $this->errorData("email already in use", 500);

   }

   $user->name       = $request->name;
   $user->username   = $request->username;
   $user->hotel_name = $request->hotel_name;
   if ($request->password !== $request->confirm_password) {
    return $this->errorData("password does not match", 500);
   }
   $user->password = Hash::make($request->password);
   $user->phone    = $request->phone;
   $userrole       = Role::where('name', 'user')->first();
   if ($user->save()) {
    $user->roles()->attach($userrole);
    $data = ['user' => $user];
    return $this->successData('User creted Successfully', $data);
   } else {
    return $this->errorData("failed to save", 500);
   }
   return $this->errorData("failed to save", 500);

  } catch (\Exception $e) {
   return $this->errorData("user already exists", 500);
  }
 }

 public function updateProfile(Request $request)
 {
  $this->validate($request, [
   'email'    => 'email',
   'username' => 'max:255',
   'phone'    => 'numeric',
  ]);
  try {
   $user = auth()->guard('api')->user();
   if ($request->hasFile('image')) {
    if ($user->image) {
     Storage::delete('public/user/' . $user->id . '/' . $user->image);
     Storage::delete('public/user/' . $user->id . '/thumb_' . $user->image);
    }
    $image    = $request->file('image');
    $filename = time() . '.' . $image->getClientOriginalExtension();
    Storage::putFileAs('public/user/' . $user->id . '/', new File($image), $filename);
    //resize_crop_images(250, 100, $image, "public/user/" . $user->id . '/thumb_' . $filename);
    $user->image = $filename;

   }
   if ($request->has('name')) {
    $user->name = $request->name;
   }
   if ($request->has('hotel_name')) {
    $user->hotel_name = $request->hotel_name;
   }
   if ($request->has('email')) {
    $user->email = $request->email;
   }
   if ($request->has('username')) {
    $user->username = $request->username;
   }
   if ($request->has('gender')) {
    $user->gender = $request->gender;
   }
   if ($request->has('dateofbirth')) {
    $user->dateofbirth = $request->dateofbirth;
   }
   if ($request->has('address')) {
    $user->address = $request->address;
   }
   if ($request->has('national_id_no')) {
    $user->national_id_no = $request->national_id_no;
   }
   if ($request->has('national_id_type')) {
    $user->national_id_type = $request->national_id_type;
   }
   if ($request->has('phone')) {
    $user->phone = $request->phone;
   }

   if ($user->save()) {
    return [
     "success" => "User updated successfully",
    ];
   } else {
    return $this->errorData("failed to update", 500);
   }
   return $this->errorData("failed to update", 500);
  } catch (\Exception $e) {
   return $this->errorData("failed to update", 500);
  }

 }

 public function changePassword(Request $request)
 {
  try {
   if ($request->newpassword != $request->confirmpassword) {
    return $this->errorData("new password and confirm password does not match", 500);
   }
   $user = auth()->guard('api')->user();
   if (!Hash::check($request->currentpassword, $user->password)) {
    return $this->errorData("password do not match", 500);
   }
   $user->password = Hash::make($request->newpassword);
   if ($user->save()) {
    return [
     "success" => "Password Updated Successfully",
    ];
   }
   return $this->errorData("failed to change password", 500);
  } catch (\Exception $e) {
   return $this->errorData("failed to change password", 500);
  }

 }

 public function sendVerificationCode(Request $request)
 {
  try {
   $user              = User::where('email', $request->email)->first();
   $verification_code = rand(1000, 9999);
   $data              = [
    'name'              => $user->name,
    'verification_code' => $verification_code,
   ];
   Mail::to($user->email)->send(new VerificationMail($data));
   $user->verification_code = $verification_code;
   if ($user->save()) {
    $msg = [
     "success" => "verification code has been sent to mail",
    ];
    return $this->successData('success', $msg);
   } else {
    return $this->errorData("failed to send verification code", 500);
   }
  } catch (\Exception $e) {
   return $e;
   return $this->errorData("failed to send verification code", 500);
  }

 }

 public function checkVerificationCode(Request $request)
 {
  try {
   $user = User::where('email', $request->email)->first();
   if ($request->verification_code == $user->verification_code) {
    return [
     "success" => "Verified",
    ];
   } else {
    return $this->errorData("verification code does not match", 500);
   }
   return $this->errorData("verification code does not match", 500);
  } catch (\Exception $e) {
   return $this->errorData("verification code does not match", 500);
  }

 }

}