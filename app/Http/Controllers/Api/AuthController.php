<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use Illuminate\Support\Facades\Password;
use App\Models\Customer_Purchase_Scheme;
use App\Notifications\VerifyEmail;
use App\Notifications\VerifyEmailAddress;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'email' => 'required|email',
            'email' => Rule::unique('users')->where(function ($query) {
                $query->where('delete', 0)->whereNotNull('email_verified_at');
            }),
            'password' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'type' => 'required|integer|min:2|max:3',
            'device_type' => 'required',
            'device_token' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        $user = User::where('email', $request->get('email'))->first();
        if ($user) {
            $user->delete =0;
            $user->name = !empty($request->name) ? $request->name : $user->name;
            $user->phone_number = !empty($request->phone_number) ? $request->phone_number : $user->phone_number;
            $user->gender = !empty($request->gender) ? $request->gender : $user->gender;
            $user->dob = !empty($request->dob) ? $request->dob : $user->dob;
            $user->email_verified_at = null;
            $user->save();
            $user->refresh();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['id'] = $user->id;
            $success['phone'] = $user->phone_number;
            $roles = Roles::find($user->type);
            $success['type'] = $roles->name;
            $success['gender'] = $user->gender;
            $success['dob'] = $user->dob;
            $success['img_url'] = $user->img;
            $success['app_purchase_plan'] = $user->app_purchase_plan;
            $success['app_purchase_plan_expiry'] = $user->app_purchase_plan_expiry;
            if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($user->app_purchase_plan_expiry)) {
                $success['is_expired'] = 'no';
            } else {
                $success['is_expired'] = 'yes';
            }
            $success['plan_status'] = $user->plan_status;
            $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $user->id], ['isOneRewardCollected', 'true']])->first();

            if ($scheme_purchase) {
                $success['isOneRewardCollected'] = true;
            } else {
                $success['isOneRewardCollected'] = false;
            }



            $user->sendEmailVerificationNotification();
            return $this->sendResponse($success, 'User register successfully.');
        }


        $input = $request->all();
        if (!isset($input['type'])) {
            $input['type'] = 3;
        } elseif ($input['type'] == 1) {
            $input['type'] = 3;
        } elseif ($input['type'] > 3 || $input['type'] < 1) {
            $input['type'] = 3;
        }
        $input['password'] = bcrypt($input['password']);
        // user is premium
        $input['app_purchase_plan'] = 'Yearly';
        $input['app_purchase_plan_expiry'] = now()->addYear(99)->format('d-m-Y');
        $input['plan_status'] = 1;
        // user is premium
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['id'] = $user->id;
        $success['phone'] = $user->phone_number;
        $roles = Roles::find($user->type);
        $success['type'] = $roles->name;
        $success['gender'] = $user->gender;
        $success['dob'] = $user->dob;
        $success['img_url'] = $user->img;
        $success['app_purchase_plan'] = $user->app_purchase_plan;
        $success['app_purchase_plan_expiry'] = $user->app_purchase_plan_expiry;
        if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($user->app_purchase_plan_expiry)) {
            $success['is_expired'] = 'no';
        } else {
            $success['is_expired'] = 'yes';
        }
        $success['plan_status'] = $user->plan_status;
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
        $validator = Validator::make($request->all(), [

            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }




        $deleted_user = User::where("email", $request->email)->where("delete", 1)->first();


        if ($deleted_user) {

            return $this->sendError('Your account is cancelled.', ['error' => 'User Deleted']);
        }


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) > strtotime($user->app_purchase_plan_expiry)) {
            //     $user->update(['plan_status' => false]);
            //     $user->save();
            //     $user->refresh();
            // }


            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['id'] = $user->id;
            $success['name'] =  $user->name;
            $success['gender'] = $user->gender;
            $success['dob'] = $user->dob;
            $success['phone'] = $user->phone_number;
            $success['img_url'] = $user->img;
            $success['app_purchase_plan'] = $user->app_purchase_plan;
            $success['app_purchase_plan_expiry'] = $user->app_purchase_plan_expiry;
            if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($user->app_purchase_plan_expiry)) {
                $success['is_expired'] = 'no';
            } else {

                $success['is_expired'] = 'yes';
            }
            $success['plan_status'] = $user->plan_status;
            $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $user->id], ['isOneRewardCollected', 'true']])->first();

            if ($scheme_purchase) {
                $success['isOneRewardCollected'] = true;
            } else {
                $success['isOneRewardCollected'] = false;
            }

            $roles = Roles::find($user->type);
            $success['type'] = $roles->name;


            if (!$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
                return $this->sendError('Please verify email.!', []);
            }
            $user->device_type = $request->device_type;
            $user->device_token = $request->device_token;
            $user->save();
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function forget(Request $request)
    {
// return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'email' => ['required','email','exists:users,email']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        Password::sendResetLink($request->all());
        return $this->sendResponse([], 'Reset password link sent on your email');
    }


    public function verify(Request $request, $id)
    {

        if (!$request->hasValidSignature()) {
            return $this->sendError('Validation Error.', ['Invalid/Expired url provided.']);
        }

        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        } else {

            return $this->sendResponse([], 'Email already verified');
        }

        return $this->sendResponse([], 'Email verified');
    }

    public function reset_password(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'token' => 'required'
            ]
        );
        //check if payload is valid before moving on
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::where('email', $request->email)->first();
        $password = $request->password;
        $tokenExist = password::tokenExists($user, $request->token);

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenExist) {
            return $this->sendError('Validation Error.', ['Reset Token invalid.']);
        }


        //Hash and update the new password
        $user->password = Hash::make($password);
        $user->update();

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $roles = Roles::find($user->type);

        $success['type'] = $roles->name;
        $success['phone'] = $user->phone_number;



        DB::table('password_resets')->where('email', $user->email)
            ->delete();




        return $this->sendResponse($success, 'Password reset successfully.');
    }


    public function sociallogin(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => "required",
                'email' => 'required_without_all:phone_number|email',
                'type' => 'required|integer|min:2|max:3',
                'phone_number' => "required_without_all:email",
                'provider' => "required",
                'dob' => 'required',
                'gender' => 'required',
                'device_type' => 'required',
                'device_token' => 'required',
            ]
        );


        //check if payload is valid before moving on
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if ($request->provider == "apple") {
            if (!isset($request->apple_token)) {
                return $this->sendError('Validation Error.', ['Apple Token missing']);
            }
            $input['apple_token'] = $request->apple_token;
        }

        // canceleed account
        $deleted_user = User::where("email", $request->email)->where("delete", 1)->first();


        if ($deleted_user) {
            $deleted_user->delete = 0;
            $deleted_user->save();
            $deleted_user->refresh();
        }

        if (!isset($request->profile_image_url)) {
            $input['profile_image_url'] = null;
        }


        // check email or number;
        $check_user_exist = null;
        $value = 'email';

        if (isset($input['email'])) {
            $check_user_exist = User::where('email', $request->email)->first();
        } elseif (isset($input['phone_number'])) {

            $check_user_exist = User::Where('phone_number', $request->phone_number)->first();
            $value = 'phone_number';
        }

        $success = null;
        if ($check_user_exist) {

            if (Auth::loginUsingId($check_user_exist->id)) {
                $check_user_exist = Auth::user();
                // if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) > strtotime($user->app_purchase_plan_expiry)) {
                //     $check_user_exist->update(['plan_status' => false]);
                //     $check_user_exist->save();
                //     $check_user_exist->refresh();
                // }
                DB::table('users')
                    ->where('id', $check_user_exist->id)
                    ->update(['device_type' => $input['device_type'], 'device_token' => $input['device_token']]);


                $success['token'] =  $check_user_exist->createToken('MyApp')->plainTextToken;
                $success['name'] =  $check_user_exist->name;
                $success['id'] = $check_user_exist->id;
                $success['gender'] = $check_user_exist->gender;
                $success['dob'] = $check_user_exist->dob;
                $success['phone'] = $check_user_exist->phone_number;
                $success['img_url'] = $check_user_exist->img;
                $roles = Roles::find($check_user_exist->type);
                $success['type'] = $roles->name;
                $success['app_purchase_plan'] = $check_user_exist->app_purchase_plan;
                $success['app_purchase_plan_expiry'] = $check_user_exist->app_purchase_plan_expiry;
                if (!empty($check_user_exist->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($check_user_exist->app_purchase_plan_expiry)) {
                    $success['is_expired'] = 'no';
                } else {
                    $success['is_expired'] = 'yes';
                }
                $success['plan_status'] = $check_user_exist->plan_status;
                $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $check_user_exist->id], ['isOneRewardCollected', 'true']])->first();

                if ($scheme_purchase) {
                    $success['isOneRewardCollected'] = true;
                } else {
                    $success['isOneRewardCollected'] = false;
                }

                return $this->sendResponse($success, 'Login Successfully.');
            } else {
                return $this->sendError('User Error.', ['No user Found']);
            }
        } else {


            try {
                // $user = Socialite::driver($input['provider'])->userFromToken($input['social_token']);
                $input['password'] = bcrypt("demodemo");
                $input['img'] = $input['profile_image_url'];
                $input['device_type'] = $input['device_type'];
                // user is premium
                $input['app_purchase_plan'] = 'Yearly';
                $input['app_purchase_plan_expiry'] = now()->addYear(99)->format('d-m-Y');
                $input['plan_status'] = 1;
                // user is premium
                $user = User::create($input);
                $success['token'] =  $user->createToken('MyApp')->plainTextToken;
                $success['name'] =  $user->name;
                $success['id'] = $user->id;
                $success['phone'] = $user->phone_number;
                $success['gender'] = $user->gender;
                $success['dob'] = $user->dob;
                $success['img_url'] = $user->img;
                $roles = Roles::find($user->type);
                $success['type'] = $roles->name;
                $success['app_purchase_plan'] = $user->app_purchase_plan;
                $success['app_purchase_plan_expiry'] = $user->app_purchase_plan_expiry;
                if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($user->app_purchase_plan_expiry)) {
                    $success['is_expired'] = 'no';
                } else {
                    $success['is_expired'] = 'yes';
                }
                $success['plan_status'] = $user->plan_status;
                $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $user->id], ['isOneRewardCollected', 'true']])->first();

                if ($scheme_purchase) {
                    $success['isOneRewardCollected'] = true;
                } else {
                    $success['isOneRewardCollected'] = false;
                }


                $user->markEmailAsVerified();
                return $this->sendResponse($success, 'Register Successfully.');
            } catch (\GuzzleHttp\Exception\ClientException $e) {

                return $this->sendError('Login Error.', ['Try Again']);
            }
        }
    }



    public function check_verify(Request $request)
    {



        //check if payload is valid before moving on





        if (Auth::guard('api')->check()) {

            $user = User::where("email", Auth::guard('api')->user()->email)->first();
            if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($user->app_purchase_plan_expiry)) {
                $user->is_expired = 'no';
            } else {
                $user->is_expired = 'yes';
            }
            $success['user'] = $user;

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['user_verify'] = $user->hasVerifiedEmail();
            $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $user->id], ['isOneRewardCollected', 'true']])->first();

            if ($scheme_purchase) {
                $success['isOneRewardCollected'] = true;
            } else {
                $success['isOneRewardCollected'] = false;
            }
            return $this->sendResponse($success, 'User Verify Successfully.');
        } else {

            $message = [];
            $message['success'] = false;
            $message['message'] =  "Unauthorised";
            $message['data'] =  ["error" => "Unauthorised"];
            return response($message, 401);
        }
    }




    public function user_status(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [

                'email' => 'required_without_all:phone_number,apple_token|email',
                'phone_number' => "required_without_all:email,apple_token",
                "apple_token" => "required_without_all:email,phone_number",
                'device_type' => 'required',
                'device_token' => 'required'
            ]
        );
        //check if payload is valid before moving on
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        //canceleed account
        $deleted_user = User::where("email", $request->email)->where("delete", 1)->first();

        if ($deleted_user) {
            $deleted_user->delete = 0;
            $deleted_user->save();
            $deleted_user->refresh();
        }
        // check email or number;
        $check_user_exist = null;
        $value = 'email';

        if (isset($input['email'])) {
            $check_user_exist = User::where('email', $request->email)->first();
        } elseif (isset($input['phone_number'])) {

            $check_user_exist = User::Where('phone_number', $request->phone_number)->first();
            $value = 'phone_number';
        } elseif (isset($input['apple_token'])) {
            $check_user_exist = User::Where('apple_token', $request->apple_token)->first();
        }

        $success = null;
        if ($check_user_exist) {
            DB::table('users')
                ->where('email', $check_user_exist->email)
                ->update(['device_type' => $input['device_type'], 'device_token' => $input['device_token']]);
            if (Auth::loginUsingId($check_user_exist->id)) {

                $check_user_exist = Auth::user();
                // if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) > strtotime($user->app_purchase_plan_expiry)) {
                //     $check_user_exist->update(['plan_status' => false]);
                //     $check_user_exist->save();
                //     $check_user_exist->refresh();
                // }
                $success['token'] =  $check_user_exist->createToken('MyApp')->plainTextToken;
                $success['name'] =  $check_user_exist->name;
                $success['email'] = $check_user_exist->email;
                $success['id'] = $check_user_exist->id;
                $success['phone'] = $check_user_exist->phone_number;
                $success['gender'] = $check_user_exist->gender;
                $success['dob'] = $check_user_exist->dob;
                $success['img_url'] = $check_user_exist->img;
                $success['app_purchase_plan'] = $check_user_exist->app_purchase_plan;
                $success['app_purchase_plan_expiry'] = $check_user_exist->app_purchase_plan_expiry;
                if (!empty($check_user_exist->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($check_user_exist->app_purchase_plan_expiry)) {
                    $success['is_expired'] = 'no';
                } else {
                    $success['is_expired'] = 'yes';
                }
                $success['plan_status'] = $check_user_exist->plan_status;

                $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $check_user_exist->id], ['isOneRewardCollected', 'true']])->first();

                if ($scheme_purchase) {
                    $success['isOneRewardCollected'] = true;
                } else {
                    $success['isOneRewardCollected'] = false;
                }


                $roles = Roles::find($check_user_exist->type);
                $success['type'] = $roles->name;
                return $this->sendResponse($success, 'Login Successfully.');
            } else {
                return $this->sendError('User Error.', ['No user Found']);
            }
        } else {

            return $this->sendError([], 'No User Found', 400);
        }
    }



    public function delete_user(Request $request)
    {

        $user = User::find(Auth::guard('api')->user()->id);

        $user->delete = 1;
        $u = DB::table("customer_loyalty")->where("customer_id", $user->id)
            ->delete();

        $user->tokens()->delete();
        $user->save();
        return $this->sendResponse([], 'User Deleted Successfully.');
    }


    public function logout(Request $request)
    {

        $user = User::find(Auth::guard('api')->user()->id);
        $user->device_token = Null;
        $user->save();
        return $this->sendResponse([], 'User Logout Successfully.');
    }
}
