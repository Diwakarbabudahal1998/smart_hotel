<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends ApiBaseController
{
    public function getMenus(){
        try{
            $menus=Menu::where('user_id',auth()->guard('api')->user()->id)->get();
            $data=['menus'=>$menus];
            return $this->successData("Success",$data);
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to get Menus",$e);
        }
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);
        try{
            $menu=new Menu();
            $menu->user_id=auth()->guard('api')->user()->id;
            $menu->title=$request->title;
            $menu->price=$request->price;
            $menu->category_id=$request->category_id;
            if($menu->save()){
                return $this->successResponse('Menu Added Successfully');
            }
            else{
                return $this->errorResponse('Unable to Add Menu');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to add Menu.",$e);
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);
        try{
            $menu=Menu::find($request->id);
            $menu->user_id=auth()->guard('api')->user()->id;
            $menu->title=$request->title;
            $menu->price=$request->price;
            $menu->category_id=$request->category_id;            
            if($menu->save()){
                return $this->successResponse('Menu Updated Successfully');
            }
            else{
                return $this->errorResponse('Unable to Update Menu');
            }
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to Update Menu",$e);
        }
    }

    public function destroy($id){
        try{
            $menu=Menu::find($id);
            if($menu->delete()){
                return $this->successResponse("Menu Deleted Successfuly");
            }
            else{
                return $this->errorResponse("Menu does not Exists");
            }
        }catch(\Exception $e){
            return $this->errorData("Internal Server Error! Unable to Delete Menu",$e);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = ($request->ids);
            Menu::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted selected Menus");
        } catch (\Exception $e) {
            return $this->errorData("Internal Server Error! Failed to delete Menus.",$e);
        }
    }
}