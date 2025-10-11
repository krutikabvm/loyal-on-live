<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Customer as CustomerResource;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Roles;
use App\Models\Business;
use App\Models\BusinessDetails;
use App\Models\Loyalty_Scheme;
use App\Models\Loyalty_location;
use DB;

class CustomerController extends BaseController
{
    //
     protected  $user;
    
    public function __construct()
        {
            $this->user=Auth::guard('api')->user();
                
        }
    
    
    public function index(){
        
         $details=User::where("type",3)
         ->orderBy('id', 'DESC')
         ->get();
        
        return $this->sendResponse(CustomerResource::collection($details), 'Customer retrieved successfully.');
    }
    
    public function Customer_detail(Request $request,$id){
        $details=User::where('id',$id)
        ->where("type",3)
        ->first();
         if ($details)
         {
         return $this->sendResponse(new CustomerResource($details), 'Customer details.');
         }else{
             
             return $this->sendResponse(["success"=>false], 'Customer Not Found.');  
         }      
        
    }
    
    
    
    public function Customer_delete(Request $request,$id){
        
           User::where("id",$id)->update([
            'delete'=>1]);
             return $this->sendResponse([], 'Customer Soft deleted successfully.');

    }
    
    
    public function update(Request $request,$id){
           $validator = Validator::make($request->all(), [
            'name' => 'required',
            "email"=>'required|email|unique:users,email'
        ]);
        
         if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $user= User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        
        return $this->sendResponse(new CustomerResource($user), 'Customer Updated successfully.');
    }
    
}
