<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends ApiBaseController
{
    public function getRooms(){
        try{
            $rooms=Room::where('user_id',auth()->guard('api')->user()->id)->get();
            $data=['rooms'=>$rooms];
            return $this->successData("Success",$data);
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to get Rooms",$e);
        }
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'type'=>'required',
            'rate'=>'required'
        ]);
        try{
            $room=new Room();
            $room->user_id=auth()->guard('api')->user()->id;
            $room->name=$request->name;
            $room->type=$request->type;
            $room->rate=$request->rate;
            //$room->status=$request->status;
            if($room->save()){
                return $this->successResponse('Room Added Successfully');
            }
            else{
                return $this->errorResponse('Unable to Add Room');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to add Room.",$e);
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'type'=>'required',
            'rate'=>'required'
        ]);
        try{
            $room=Room::find($request->id);
            $room->user_id=auth()->guard('api')->user()->id;
            $room->name=$request->name;
            $room->type=$request->type;
            $room->rate=$request->rate;    
           // $room->status=$request->status;        
            if($room->save()){
                return $this->successResponse('Room Updated Successfully');
            }
            else{
                return $this->errorResponse('Unable to Update Room');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to Update Room",$e);
        }
    }

    public function destroy($id){
        try{
            $room=Room::find($id);
            if($room->delete()){
                return $this->successResponse("Room Deleted Successfuly");
            }
            else{
                return $this->errorResponse("Room does not Exists");
            }
        }catch(\Exception $e){
           return $this->errorData("Internal Server Error! Unable to Delete Room",$e);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = ($request->ids);
            Room::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted selected Rooms");
        } catch (\Exception $e) {
            return $this->errorData("Internal Server Error! Failed to delete Rooms.",$e);
        }
    }
}