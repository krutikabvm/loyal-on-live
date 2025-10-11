<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\Business;
use App\Models\BusinessDetails;
use App\Models\Loyalty_Scheme;
use App\Models\Loyalty_location;
use App\Http\Resources\Busniness as BusninessResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusinessController extends BaseController
{
    
     protected  $user;
    
    public function __construct()
{
    $this->user=Auth::guard('api')->user();
        
}


     public function register(Request $request)
    {
        
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'dob'=>'required',
            'gender'=>'required',
            'business_name' => 'required|unique:business,business_name',
            'description' =>"required",
            'facebook_link' => "required_without_all:twitter_link,instagram_link",
            'twitter_link' => "required_without_all:facebook_link,instagram_link",
            'instagram_link' => "required_without_all:twitter_link,facebook_link",
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $input = $request->all();
        $input['type'] = 2;
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $input['user_id']=$user->id;
        $roles=Roles::find($user->type);
        $success['type'] = $roles->name;
        
        $business = $this->insertBusiness($input);
        $success['business'] = $business;
        $user->sendEmailVerificationNotification();
        return $this->sendResponse($success, 'Business register successfully.');
    }
   
   
   public function regsiterStep_2(Request $request){
       
      
       
         $validator = Validator::make($request->all(), [
            'package' => 'required',
            'image' => 'mimes:jpeg,jpg,png|required',
              ]);
              
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $extension = $request->image->extension();
        $imageName = time().'.'.$extension; 
        $request->image->move(public_path('images'), $imageName);
        $business=Business::where("user_id",$this->user['id'])->update(['image'=>"images/".$imageName]);
        $success['business']=Business::where("user_id",$this->user['id'])->first();
        $success['user']=User::find($this->user['id'])->first();
         return $this->sendResponse(new BusninessResource($success['business']), 'Business Image register successfully.');
   
       
   }
   
  
   public function regsiterStep_3(Request $request){
       
       $businessDetail=[];
        $business=Business::where("user_id",$this->user['id'])->first();
        
       
       
       foreach($request->data as $data)
       {
        $validator = $this->validator($data);
       if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $data['business_id']=$business->id;
        $count = BusinessDetails::where("business_id",$business->id)->count();
        if ($count <3 )
        {$businessDetail[]=BusinessDetails::create($data);}
        else{
            $businessDetail[]=array("success"=>false,"message"=>"Limit Reached");
            
        }
           
       }

               return $this->sendResponse($businessDetail, 'Business Details register successfully.');
        
       
   }
   
   
   public function regsiterStep_4(Request $request){
        $businessDetail=[];
        $business=Business::where("user_id",$this->user['id'])->first();
        
        
        // 
        
        foreach($request->data as $data)
       {
        $validator = $this->validator_loyalty($data);
       if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $data['business_id']=$business->id;
        $count = Loyalty_Scheme::where("business_id",$business->id)->count();
        if ($count <3 )
        {$businessDetail[]=Loyalty_Scheme::create($data);}
        else{
            $businessDetail[]=array("success"=>false,"message"=>"Loyalty Limit Reached");
            
        }
           
       }
        
        return $this->sendResponse($businessDetail, 'Business Loyalty Details register successfully.');
        
       
   }
   
   
   public function regsiterStep_5(Request $request){
        $businessDetail=[];
        $business=Business::where("user_id",$this->user['id'])->first();
        
        
        // 
        
        foreach($request->data as $data)
       {
        $validator = Validator::make($data, [
            'key'=>'required',
            'stamp_id'=>"required"
              ]);
       if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $data['business_id']=$business->id;
        $count = Loyalty_location::where("business_id",$business->id)
        ->where("stamp_id",$data['stamp_id'])
        ->count();
        if ($count ==0 )
        {
            $check=DB::table("loyalty_scheme")->where("business_id",$data['business_id'])
            ->where("id",$data['stamp_id'])->count();
            
            if($check==1){
                
            $businessDetail[]=Loyalty_location::create($data);
            }else{
                
                 $businessDetail[]=array("success"=>false,"message"=>"Loyalty Scheme Doesnt exist");
            }
            
        }
        else{
               $businessDetail[]=array("success"=>false,"message"=>"Loyalty Scheme already exist at this location");
        }
        
           
       }
        Business::where("id",$business->id)->update(['verify'=>"pending"]);
            
          return $this->sendResponse(new BusninessResource($business), 'Business Registration Complete.');
        
        // return $this->sendResponse($businessDetail, 'Loyalty Scheme Added to location');
        
       
       
       
       
       
   }
   
   public function validator($data){
       
      return Validator::make($data, [
            // 'business_id' => 'required',
            'address' => 'required',
            'lat' =>"required",
            "lon"=> "required",
            "country" => "required",
            "city"=>"required",
            "open_time" =>"required",
            "close_time" =>"required",
            "open_days" =>"required",
              ]);
              
              
              
       
       
   }
   
   public function validator_loyalty($data){
       return Validator::make($data,[
            'business_id' => 'required',
            'name' => 'required',
            'description'=>"required",
            'number_stamps'=>"required|numeric|min:2|max:15",
            'offer_expiry' =>"date_format:Y-m-d|after:today"
           
           ]);
       
   }
   
    public function insertBusiness($data){
        return Business::create($data);
        // dd($data);
    }
    
    
    
    public function details(Request $request){
    
        $details=Business::where("user_id",$this->user['id'])->first();
        
         return $this->sendResponse(new BusninessResource($details), 'Business Details.');
    
        
        
        
    }
    
    
}
