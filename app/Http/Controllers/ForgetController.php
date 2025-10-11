<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Roles;
use DB;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class ForgetController extends Controller
{
    //

    public function reset_form(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required','email','exists:users,email'],
                'token' => ['required']
            ]
        );
        $input = $request->input();
        $error = 0;

        if ($validator->fails()) {
            $error = 1;


            $message = "Validation Failed! Please Reset Again";
            return view("mobile.forget")->with("error", $error)->with("message", $message);
        }

        $user = User::where('email', $request->email)->first();
        $tokenExist = password::tokenExists($user, $request->token);


        if (!$tokenExist) {

            DB::table('password_resets')->where('email', $user->email)->delete();
            $error = 1;
            $message = "Link Expired! Please Reset Again";
            return view("mobile.forget")->with("error", $error)->with("message", $message);
        }


        return view("mobile.forget")->with("data", $input)->with("error", $error);
    }

    public function reset_post(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'e' => 'required|email|exists:users,email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'reset_token' => 'required'
            ]
        );



        if ($validator->fails()) {

            $message = "Validation Failed! Please Reset Again";
            return view("mobile.forget")->with("error", 1)->with("message", $message);
        }


        $user = User::where('email', $request->e)->first();
        $password = $request->password;
        $user->password = \Hash::make($password);
        $user->update();

        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        return view("mobile.forget")->with("error", 3)->with("message", "Updated Password For " . $user->email);
    }


    public function verify(Request $request, $id)
    {


        // foreach(array_keys($request->all()) as $key)
        // {
        //     if(in_array($key,['expires','signature'])){
        //         $request->request->remove($key);
        //     }
        // }
        // dd($request->all());
        //   if (!$request->hasValidSignature(false)) {
        //   $error=1;


        //     $message="Verification Failed";
        //    return view("mobile.forget")->with("error",$error)->with("message",$message);  
        // }

        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        } else {

            $error = 3;


            $message = "Already Verify";
            return view("mobile.forget")->with("error", $error)->with("message", $message);
        }

        $error = 3;
        $message = "Verification Successful";
        return view("mobile.forget")->with("error", $error)->with("message", $message);
    }
}
