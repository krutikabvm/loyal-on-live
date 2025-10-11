<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Roles;
use DB;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'dob'=>'required',
            'gender'=>'required',
            'type'=> 'required|integer|min:2|max:3',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $input = $request->all();
        if(!isset($input['type'])){
            $input['type'] = 3;
          
         
        }
        elseif($input['type']==1){
            $input['type']=3;
        }
        elseif($input['type'] > 3 || $input['type'] < 1){
                $input['type'] = 3;

        }
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $roles=Roles::find($user->type);
        $success['type'] = $roles->name;
        $success['gender']=$user->gender;
        $success['dob']=$user->dob;
        $success['img_url']=$user->img;
        $user->sendEmailVerificationNotification();
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        
       

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['gender']=$user->gender;
            $success['dob']=$user->dob;
            $success['img_url']=$user->img;
            $roles=Roles::find($user->type);
            $success['type'] = $roles->name;
     
    
            if (!$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
            }

            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    
    public function forget(Request $request) {
      
         $validator = Validator::make($request->all(), [
         'email' => 'required|email|exists:users,email'
          
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        Password::sendResetLink($request->all());
        return $this->sendResponse([], 'Reset password link sent on your email');
        
    }
    

    public function verify(Request $request,$id){

        if (!$request->hasValidSignature()) {
            return $this->sendError('Validation Error.', ['Invalid/Expired url provided.']);       
        }
    
        $user = User::findOrFail($id);
    
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }else{

            return $this->sendResponse([], 'Email already verified');
        }

        return $this->sendResponse([], 'Email verified');

    }
    
     public function reset_password(Request $request) {
         
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
        'password' => 'required',
        'c_password' => 'required|same:password',
        'token' => 'required' ]
    );
  //check if payload is valid before moving on
    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    $user = User::where('email', $request->email)->first();
    $password = $request->password;
    $tokenExist=password::tokenExists($user,$request->token);
    
// Redirect the user back to the password reset request form if the token is invalid
    if (!$tokenExist){ 
        return $this->sendError('Validation Error.', ['Reset Token invalid.']);       
    }

 
    //Hash and update the new password
    $user->password = \Hash::make($password);
    $user->update(); 

    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    $roles=Roles::find($user->type);
    
    $success['type'] = $roles->name;

   

    DB::table('password_resets')->where('email', $user->email)
    ->delete();
  



    return $this->sendResponse($success, 'Password reset successfully.');
     }


 public function sociallogin(Request $request){
    $input=$request->all();
    $validator = Validator::make($request->all(), [
        'name'=>"required",
        'email' => 'required_without_all:phone_number|email',
        'type'=> 'required|integer|min:2|max:3',
        'phone_number' => "required_without_all:email",
        'provider'=>"required",
        'dob'=>'required',
        'gender'=>'required',
        'profie_image_url'=>'required',
        'social_token' => 'required' ]
    );

     //check if payload is valid before moving on
     if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    // check email or number;
    $check_user_exist=null;
    $value='email';

    if(isset($input['email'])){
        $check_user_exist=User::where('email',$request->email)->first();
    }
    elseif(isset($input['phone_number'])){

        $check_user_exist=User::Where('phone_number',$request->phone_number)->first();
        $value='phone_number';
    }

    $success=null;
    if($check_user_exist){

        if(Auth::loginUsingId($check_user_exist->id))
        { 
        $check_user_exist = Auth::user(); 
        $success['token'] =  $check_user_exist->createToken('MyApp')->accessToken;
        $success['name'] =  $check_user_exist->name;
        $roles=Roles::find($check_user_exist->type);
        $success['type'] = $roles->name;
        return $this->sendResponse($success, 'Login Successfully.');

        }else{
            return $this->sendError('User Error.', ['No user Found']);
        }

    }
    
    else{


        try {
            $user = Socialite::driver($input['provider'])->userFromToken($input['social_token']);
            $input['password'] = bcrypt("demodemo");
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $roles=Roles::find($user->type);
            $success['type'] = $roles->name;
            return $this->sendResponse($success, 'Register Successfully.');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
           
            return $this->sendError('Login Error.', ['Try Again']);
           
        }

       
    }

      
        
    }
    
    
    
    public function check_verify(Request $request){
        
       

     //check if payload is valid before moving on
   
       
    
    
    
     if (Auth::guard('api')->check()) {
             
        $user=User::where("email",Auth::guard('api')->user()->email)->first();
        $success['user']=$user;
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['user_verify']=$user->hasVerifiedEmail();
       return $this->sendResponse($success, 'User Verify Successfully.');
    } 
    else {
        
        $message =[];
        $message['success']= false;
        $message['message'] =  "Unauthorised";
        $message['data']=  ["error"=> "Unauthorised"];
        return response($message, 401);
    }
        
    
    }

}
