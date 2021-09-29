<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends ApiBaseController
{
    public function getRoomTypes(){
        try{
            $roomtype=RoomType::where('user_id',auth()->guard('api')->user()->id)->get();
            $data=['roomtypes'=>$roomtype];
            return $this->successData("Success",$data);
        }catch(\Exception $e){
            $this->errorData("Internal Server Error! Unable to get Room Types",$e);
        }
    }
    public function store(Request $request){
        $this->validate($request,[
            'type_name'=>'required',
        ]);
        try{
            $type=new RoomType();
            $type->user_id=auth()->guard('api')->user()->id;
            $type->type_name=$request->type_name;
            if($type->save()){
                return $this->successResponse('Room Type Added Successfully');
            }
            else{
                return $this->errorResponse('Unable to Add Room Type');
            }
        }catch(\Exception $e){
            $this->errorData("Internal Server Error! Unable to add Room Type",$e);
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'type_name'=>'required',
        ]);
        try{
            $type=RoomType::find($request->id);
            $type->user_id=auth()->guard('api')->user()->id;
            $type->type_name=$request->type_name;
            if($type->save()){
                return $this->successResponse('Room Type Updated Successfully');
            }
            else{
                return $this->errorResponse('Unable to Update Room Type');
            }
        }catch(\Exception $e){
            $this->errorData("Internal Server Error! Unable to Update Room Type",$e);
        }
    }

    public function destroy($id){
        try{
            $type=RoomType::find($id);
            if($type->delete()){
                return $this->successResponse("Room Type Deleted Successfuly");
            }
            else{
                return $this->errorResponse("Room Type does not Exists");
            }
        }catch(\Exception $e){
            $this->errorData("Internal Server Error! Unable to Delete Room Type",$e);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = ($request->ids);
            RoomType::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted selected Room Types");
        } catch (\Exception $e) {
            return $this->errorData("Internal Server Error! Failed to delete Room Types.",$e);
        }
    }
}