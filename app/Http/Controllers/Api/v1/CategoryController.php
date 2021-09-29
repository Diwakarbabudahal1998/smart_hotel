<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends ApiBaseController
{
        public function getCategories(){
            try{
                $categories=Category::where('user_id',auth()->guard('api')->user()->id)->get();
                $data=['categories'=>$categories];
                return $this->successData("Success",$data);
            }catch(\Exception $e){
                return $this->errorData("Internal Server Error! Unable to get categorys",$e);
            }
        }
        public function store(Request $request){
            $this->validate($request,[
                'name'=>'required',
            ]);
            try{
                $category=new Category();
                $category->user_id=auth()->guard('api')->user()->id;
                $category->name=$request->name;
                $category->type=$request->type;
                $category->icon=$request->icon;
                if($category->save()){
                    return $this->successResponse('Category Added Successfully');
                }
                else{
                    return $this->errorResponse('Unable to Add Category');
                }
            }catch(\Exception $e){
                $this->errorData("Internal Server Error! Unable to add Category.",$e);
            }
        }
    
        public function update(Request $request){
            $this->validate($request,[
                'name'=>'required',
            ]);
            try{
                $category=Category::find($request->id);
                $category->user_id=auth()->guard('api')->user()->id;
                $category->name=$request->name;
                $category->type=$request->type;
                $category->icon=$request->icon;            
                if($category->save()){
                    return $this->successResponse('Category Updated Successfully');
                }
                else{
                    return $this->errorResponse('Unable to Update Category');
                }
            }catch(\Exception $e){
                $this->errorData("Internal Server Error! Unable to Update Category",$e);
            }
        }
    
        public function destroy($id){
            try{
                $category=Category::find($id);
                if($category->delete()){
                    return $this->successResponse("Category Deleted Successfuly");
                }
                else{
                    return $this->errorResponse("Category does not Exists");
                }
            }catch(\Exception $e){
                $this->errorData("Internal Server Error! Unable to Delete Category",$e);
            }
        }
    
        public function deleteMass(Request $request)
        {
            try {
                $ids = json_decode($request->ids);
                Category::whereIn('id', $ids)->delete();
                return $this->successResponse("Successfully deleted selected Categories");
            } catch (\Exception $e) {
                return $this->errorData("Internal Server Error! Failed to delete Categories.",$e);
            }
        }
}
