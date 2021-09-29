<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends ApiBaseController
{
    public function getTable(){
        try{
            $table=Table::where('user_id',auth()->guard('api')->user()->id)->get();
            $data=['tables'=>$table];
            return $this->successData('Success',$data);
        }catch(\Exception $e){
            return $this->errorData('Internal Server Error.Unabel to get tables',$e);
        }
    }
    public function store(Request $request){
        $this->validate($request,[
            'table_no'=>'required',
        ]);
        try{
            $table= new Table();
            $table->user_id=auth()->guard('api')->user()->id;
            $table->table_no=$request->table_no;
            if($table->save()){
                return $this->successResponse('Table added Successfuly');
            }else{
                return $this->errorResponse('Unable to add Table Successfuly');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal server error. Failed to add table",$e);
        }
    }

    public function update(Request $request){
        
        try{
            $table=Table::find($request->id);
            $table->user_id=auth()->guard('api')->user()->id;
            if($request->has('table_no')){
                $table->table_no=$request->table_no;
            }
            if($table->save()){
                return $this->successResponse('Table updated Successfuly');
            }else{
                return $this->errorResponse('Unable to update Table Successfuly');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal server error. Unable to update table",$e);
        }
    }

    public function destroy($id){
        
        try{
            $table=Table::find($id);
           
            if($table->delete()){
                return $this->successResponse('Table Deleted Successfuly');
            }else{
                return $this->errorResponse('Unable to delete Table Successfuly');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal server error. Unable to delete table",$e);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = ($request->ids);
            if(Table::whereIn('id', $ids)->delete()){
                return $this->successResponse("Successfully deleted selected Tables");
            }
            else{
                return $this->errorResponse("Unable to delete selected Tables.");
            }
        } catch (\Exception $e) {
            return $this->errorData("Internal Server Error! Failed to delete Tables.",$e);
        }
    }

}