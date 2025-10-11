<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Support;
use App\Models\UserAppSettings;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SupportController extends BaseController
{
      public function categories(Request $request){
        
        $cats=["Clothes","Shoes","Medicines","Electronics Items","Bakery item"
                    ];
                    
                       return $this->sendResponse($cats, 'Catgories retrieved successfully.');
    }
   
   public function support(Request $request){
       
       $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|exists:users,email',
            'category_id'=>'required|integer|min:1|max:5',
           'describe'=>"required",
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
       
        
        $cats= $cats=["Clothes","Shoes","Medicines","Electronics Items","Bakery item"
                    ];
                    
        $input=$request->all();
        
        $input['category']=$cats[$request->category_id];
        
        
        
        
        $users=DB::table("users")->where("type",1)->get();
        
        
        foreach($users as $user){
        $details['admin_name'] = $user->name;
        $details['user_name']=$request->name;
        $email=$user->email;
        $this->dispatch(new SendEmailJob($details,$email));

}

        $result=Support::create($input);
        
        return $this->sendResponse($result,"Submitted Successfully");
                    
                   
   }

   public function set_notification(Request $request){
      $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'notification' => 'required',
        ]);
   
      if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());       
      }  

      $check_notification = UserAppSettings::where('user_id',$request->get('user_id'))->first();
      if($check_notification){
        $notification = UserAppSettings::find($check_notification->id);
        $notification->notifications = $request->get('notification');
        $notification->save();
        $notifications = UserAppSettings::where('user_id',$request->get('user_id'))->get();

      }else{
        $notifications = UserAppSettings::create($request->all());
      }

      return $this->sendResponse($notifications,"Notification updated Successfully");

   }


}
