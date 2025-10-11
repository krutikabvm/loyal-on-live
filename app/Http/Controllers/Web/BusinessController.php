<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use App\Models\Business;
use App\Models\Loyalty_Scheme;
use App\Models\Loyalty_location;
use App\Models\BusinessDetails;
use Stripe\Charge;
use Stripe\Stripe;
use Validator;
use Illuminate\Support\Facades\Password;
use App\Models\Plans;
use Image;
use Illuminate\Support\Facades\File;


class BusinessController extends Controller
{
    //


    public function forget()
    {

        return view("mobile.forget");
    }

    public function forget_page()
    {

        return view("business.forgot");
    }


    public function index(Request $request)
    {

        return view("business.login");

    }

    public function forget_page_post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);


        if ($validator->fails()) {
            return redirect()->route("forget.page")
                ->withError("Email Not exist");

        }

        $check = User::where("email", $request->email)->first();
        $in = [];
        $in['email'] = $request->email;


        if ($check->type == 2) {

            Password::sendResetLink($in);
            return redirect()->route("forget.page")
                ->withSuccess("Mail sent");
        } else {


            return redirect()->route("forget.page")
                ->withError("No Business Email exist");


        }
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'

        ]);


        if ($validator->fails()) {
            return redirect()->route("login")
                ->withError("Try Again");

        }


        $user = User::where("email", $request->email)->first();
        if ($user->type == 2) {
        	if($user->account_status == "pending"){
        		return redirect()->route("business.active");
        	}

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if ($user->delete == 0) {
                    $business = DB::table("business")->where("user_id", Auth()->user()->id)
                        ->first();
                    if ($business) {
                        //   if($business->paid==){
                        // Auth::logout();
                        return redirect()->route("business.home")
                            ->withSuccess("Business Login Sucessfully!");
                        //   }
                    }
                    return redirect()->route("step1.page")
                        ->withSuccess('Business Login Sucessfully!');
                }else{
                     return redirect()->route("business.account");
                }
            }

            return redirect()->route("login")
                ->withError('Login details are not valid!');
        }else if ($user->type == 1)  { //check if admin
              $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                   
                return redirect()->route("admin.business");
            }

            return redirect()->route("login")
                ->withError('Login details are not valid!');
        } else {
            return redirect()->route("login")
                ->withError('Business Not Registered!');
        }

    }
    public function active()
    {

        return view("business_dashboard.active1");

    }
    public function activate_account(Request $request)
    {
    	 $validator = Validator::make($request->all(), [
            'digit1' => 'required',
            'digit2' => 'required',
            'digit3' => 'required',
            'digit4' => 'required',

        ]);
       if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            $message = [];
            foreach ($errors as $key => $error) {

                if (isset($error[0])) {
                    $message[] = $error[0];
                } else {
                    $message[] = $error;
                }
            }
            return redirect()->back()
                ->withError(implode(" ", $message));
         }   
        $digit =  $request->get('digit1').$request->get('digit2').$request->get('digit3').$request->get('digit4');
        $user = User::where([ ['activation_code',$digit], ['account_status','pending'] ])->first();
        if($user){
        	User::where("id", $user->id)->update(['account_status' => "active"]);
        	Auth::login($user);
        	return redirect()->route("business.home")
                        ->withSuccess('Account activated successfully');

        }else{
        	return redirect()->route("login")
                ->withError('Invalid activation code or your account is already active');
        }
    }
    public function register(Request $request)
    {

        return view("business.signup");
    }


    public function register_business(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages();

            $message = [];
            foreach ($errors as $key => $error) {

                if ($key == 'email') {
                    $message[] = "Email Already Exist";
                    break;
                } elseif ($key == 'c_password') {
                    $message[] = "Password Doesn't Match";
                    break;
                } else {

                    if (isset($error[0])) {
                        $message[] = $error[0];
                    } else {
                        $message[] = $error;
                    }

                    break;
                }
            }


            return redirect()->back()
                ->withError(implode(" ", $message));

        }

        $input = $request->all();
        $input['type'] = 2;
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        return redirect()->route("step1.page")
            ->withSuccess("Welcome!");


    }

    public function step1(Request $request)
    {
        if (Auth::check()) {
            $step_number = 0;
            $check = db::table("business")->where("user_id", Auth()->user()->id)->first();

            $plans = Plans::all();

            $loyalty_scheme = array();
            $logo = null;
            $cover_img = null;
            $locations = null;
            $email = Auth()->user()->email;
            $businessLocation = null;
            if (!empty($check)) {
                if ($check) {
                    $step_number = 1;
                }
                if ($check->plan) {
                    $step_number = 2;
                }


                if ($check->image) {
                    $logo = $check->image;
                }

                if ($check->cover_img) {
                    $cover_img = $check->cover_img;
                }

                $bus_lo = DB::table("business_details")
                    ->where("business_id", $check->id)->first();

                if ($bus_lo) {
                    $step_number = 3;
                }

                $loyalty_scheme = DB::table("loyalty_scheme")
                    ->where("business_id", $check->id)->get();


                $businessLocation = $check->business_address;
                if ($loyalty_scheme->first()) {
                    $step_number = 4;
                    $locations = BusinessDetails::
                    where("business_id", $check->id)->select('*')->get();
                }
                
            }
$account_settings = DB::table("web_settings")->where('id',1)->first();


            return view("business.steps")
                ->with("step_number", $step_number)
                ->with("logo", $logo)
                ->with("data", $check)
                ->with("cover", $cover_img)
                ->with("email", $email)
                ->with('loyalty_scheme', $loyalty_scheme)
                ->with('businessLocation',$businessLocation)
                ->with('plans',$plans)
                ->with("locations", $locations)
                ->with("account_settings",$account_settings);

        } else {
            return redirect()->route("business.login.page")
                ->withError("Please Login First");
        }
    }

    //   public function contactInfo(){

    //     return view("business.ContactInfo");
    // }


    public function contactInfo_save(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'business_name' => 'required',
            'business_email' => 'required',
            'business_number' => "required",
            'business_address' => "required",
             'lat'=>"required",
             //'lon'=>"required"
        ],[
            'lat.required'=>'Please Select Business Address from Suggestions Dropdown',
        ]);


        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);


        }


        try {

            $business_detail = $this->get_address($request->business_address);

            if ($business_detail['status'] != "OK") {
                $error = ["Business" => array("No Address Found")];
                return response()->json([
                    "errors" => $error
                ], 400);

            }
            $formatted_address = $business_detail['candidates'][0]['formatted_address'];
            $lat = $business_detail['candidates'][0]['geometry']['location']['lat'];
            $lon = $business_detail['candidates'][0]['geometry']['location']['lng'];


        } catch (\Exception $e) {

            dd($e->getMessage(),$e->getline());
            $error = ["Business" => array("No Address Found")];
            return response()->json([
                "errors" => $error
            ], 400);
        }

        $input = $request->input();
        $input['lat'] = $lat;
        $input['lon'] = $lon;
        //$input['business_address'] = $formatted_address;
        $input['business_address'] = $request->business_address;
        $input['verify'] = "success";


        DB::table("users")->where("id", Auth()->user()->id)->update(['name' => $request['name']]);
        $input['description'] = " ";
        $input['user_id'] = Auth()->user()->id;
        unset($input['_token']);
        unset($input['name']);
        unset($input['q']);
        // $business=Business::create($input);
        // dd($input);
        $business = Business::updateOrInsert(
            ["user_id" => Auth()->user()->id],
            $input
        );


        return response()->json([
            "business" => $business
        ], 200);


        //  return redirect()->route("business.plans.page")
        // ->withSuccess("Choose Payment!");


    }


    public function plans()
    {

        return view("business.Plans");
    }


    public function plans_save(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'plan' => "required",
        ]);


        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);

        }

        $b = Business::where("user_id", Auth()->user()->id)
            ->update(['plan' => $request->plan]);

        return response()->json([
            "business" => $b,
            'plan' => $request->plan
        ], 200);

    }


    public function YourBusiness()
    {

        return view("business.YourBusiness");
    }


    public function YourBusiness_save(Request $request)
    {

        $input = $request->input();


        $input['twitter_link'] = null;

        $business = Business::where("user_id", Auth()->user()->id)->first();

        if ($input['facebook_link'] != null) {
            $business->facebook_link = $input['facebook_link'];

        }
        if ($input['instagram_link'] != null) {
            $business->instagram_link = $input['instagram_link'];

        }
        if ($input['desc'] != null) {
            $business->description = $input['desc'];
            //     Business::where("user_id",Auth()->user()->id)
            // ->update(['description'=>$input['desc']]);
        }

        if ($input['twitter_link'] != null) {
            $business->twitter_link = $input['twitter_link'];

        }
        $business->save();
        // $business->plan=4;
        return response()->json([
            "business" => $business
        ], 200);

    }


    public function submit()
    {

        return view("business.Submit");
    }


    public function complete()
    {

        return view("business.Complete");
    }


    public function Complete1()
    {

        return view("business.Complete1");
    }


    public function Complete3()
    {

        return view("business.Complete3");
    }


    public function ls1()
    {

        return view("business.LS1");
    }


    public function LoyalityScheme()
    {
        $businesDetail = business::where("user_id", auth()->user()->id)->first();
        // $businessDetail=BusinessDetails::where("business_id",$business->id)->get();
        return view("business.LoyalityScheme")->with("businessDetail", $businesDetail);
    }


    public function LoyalityScheme_save(Request $request)
    {
      //  return $request->all();
        $business = Business::where("user_id", auth()->user()->id)->first();
        $businessDetail = [];
        $data = $request->input();


        $data[1]['business_id'] = $business->id;
        $data[1]['name'] = $data['l_name'];
        $data[1]['img'] = $data['scheme-logo'];
        $data[1]['number_stamps'] = $data['number_stamps'];
        $data[1]['description'] = $data['description'];

        if (!empty($data['other_description'])) {
            $data[1]['other_description'] = $data['other_description'];
        }


        if (isset($data['is_logo'])) {
            $data[1]['is_logo'] = $data['is_logo'];
        } else {
            $data[1]['is_logo'] = 0;
        }


        $data[1]['offer_expiry'] = now()->addYear('1')->format('Y-m-d');
        $count = Loyalty_Scheme::where("business_id", $business->id)->count();
        $plan = $business->plan;
        $check_count = 1;
        if ($plan == 2 || $plan == 4) {
            $check_count = 3;
        }

        if ($plan == 2) {
            if (isset($data['number_stamps_2'])) {
                $data[2]['business_id'] = $business->id;
                $data[2]['name'] = $data['l_name_2'];
                $data[2]['img'] = $data['scheme-logo_2'];
                $data[2]['number_stamps'] = $data['number_stamps_2'];
                $data[2]['description'] = $data['description_2'];
                if (isset($data['other_description_2'])) {
                    $data[2]['other_description_2'] = $data['other_description_2'];
                }
                $data[2]['offer_expiry'] = now()->addYear('1')->format('Y-m-d');

                if (isset($data['is_logo_2'])) {
                    $data[2]['is_logo'] = $data['is_logo_2'];
                    $data[2]['img'] = $business->image;
                } else {
                    $data[2]['is_logo'] = 0;
                }
            }

        }

        // if ($count <$check_count )
        // {
        unset($data['_token']);
        unset($data['scheme-logo']);
        unset($data['l_name']);
        unset($data['scheme-logo_2']);
        unset($data['l_name_2']);

        Loyalty_Scheme::where("business_id", $business->id)->delete();

        $businessDetail[] = Loyalty_Scheme::create([
            'business_id' => $business->id, 'name' => $data[1]['name'],
            'description' => $data[1]['description'],
            'img' => $data[1]['img'],
            'other_description' => !empty($data[1]['other_description']) ? $data[1]['other_description']:null,
            'number_stamps' => $data[1]['number_stamps'],
            'is_logo' => $data[1]['is_logo'],
            'offer_expiry' => $data[1]['offer_expiry'],

        ]);

        if (isset($data[2])) {
            $businessDetail[] = Loyalty_Scheme::create([
                'business_id' => $business->id, 'name' => $data[2]['name'],
                'description' => $data[2]['description'], 'img' => $data[2]['img'],
                'other_description' => isset($data[2]['other_description_2']) ? $data[2]['other_description_2']:null,
                'number_stamps' => $data[2]['number_stamps'],
                'is_logo' => $data[2]['is_logo'],
                'offer_expiry' => $data[2]['offer_expiry'],

            ]);
        }


        $response_code = 200;
        // }

        // else{
        //     $response_code=400;
        //     $businessDetail[]="Loyalty Limit Reached";


        // }

        $getLocation = $business->business_address;

        $bus_location = DB::table("business_details")
            ->where("business_id", $business->id)->get();

        return response()->json([
            "business" => $businessDetail,
            'getLocation' => $getLocation,
            'bus_location' => $bus_location

        ], $response_code);


    }


    public function YourBusiness2()
    {

        return view("business.YourBusiness2");
    }

    public function YourBusiness2_save(Request $request)
    {


        $businessDetail = [];
        $input = $request->input();
        // dd($input);

        $business = business::where("user_id", auth()->user()->id)->first();

        $check = BusinessDetails::where("business_id", $business->id)->count();

        // $location_number=1;
        // if($business->plan==3 ||$business->plan==4)
        // {
        //     $location_number=3;
        // }


        // if ($check <$location_number)
        // {

        if (isset($input['c1'])) {

            $values['business_id'] = $business->id;
            if (isset($input['same_address'])) {
                $values['address'] = $business->business_address;
                $values['lat'] = $business->lat;
                $values['lon'] = $business->lon;
            }
            if (isset($input['address'])) {

                // start
                try {

                    $business_detail = $this->get_address($request->address);


                    if ($business_detail['status'] != "OK") {
                        $error = ["Business" => array("No Address Found")];
                        return response()->json([
                            "errors" => $error
                        ], 400);

                    }
                    $formatted_address = $business_detail['candidates'][0]['formatted_address'];


                    $lat = $business_detail['candidates'][0]['geometry']['location']['lat'];
                    $lon = $business_detail['candidates'][0]['geometry']['location']['lng'];


                } catch (\Exception $e) {

                    $error = ["Business" => array("No Address Found")];
                    return response()->json([
                        "errors" => $error
                    ], 400);
                }

                // end

               // $values['address'] = $formatted_address;
                $values['address'] = $request->address;
                $values['lat'] = $lat;
                $values['lon'] = $lon;
                $values['country'] = $business_detail['country'];
                $values['city'] = $business_detail['city'];
            }


            // $values['country']="pakistan";
            // $values['city']="grw";
            $data = $this->getdayslocation($input);
            $days = $data['days'];
            $close = $data['close_time'];
            $open = $data['open_time'];
            $values['open_time'] = json_encode($open);
            $values['close_time'] = json_encode($close);
            $values['open_days'] = json_encode($days);


            $businessDetail[] = BusinessDetails::updateOrInsert(
                ["business_id" => $business->id], $values);

            // }

            return response()->json([
                "business" => $businessDetail
            ], 200);


        } else {
            return response()->json([
                "Limit" => "Reached"
            ], 200);

        }


    }


    public function imgs(Request $request)
    {


        if ($request->type == "logo") {
            $folderPath = "images/";
            $image_parts = explode(";base64,", $request->img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.' . $image_type;
            file_put_contents($file, $image_base64);

            $business = Business::where("user_id", auth()->user()->id)->update(['image' => $file]);
        }

        return $file;


    }

    public function imgs_scheme(Request $request)
    {


        // $folderPath = "images/";
        // $fullpath = public_path($folderPath);
        // if (!file_exists($fullpath)) {
        //     File::makeDirectory($path, 0777, true);
        // }
        
        // $image_parts = explode(";base64,", $request->img);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);
        // $file = $folderPath . uniqid() . '.' . $image_type;
        // // file_put_contents($file, $image_base64);
        // Image::make($image_base64)->save( $file);
        
          $image = $request->img;
        $ext = $image->getClientOriginalExtension();
        $fileName = $image->getClientOriginalName();
        $fileNameUpload = time() . "-" .uniqid(). '.'. $ext;
        // $drive = 'images/';
        // $path = public_path($drive);
        // if (!file_exists($path)) {
        //     File::makeDirectory($path, 0777, true);
        // }
        //  Image::make($image)->save( $drive . $fileNameUpload);

        $request->img->move(public_path('images/'), $fileNameUpload);


        $saveFile = 'images/'.$fileNameUpload;

        if ($request->type == "my_file1") {
            $business = Business::where("user_id", auth()->user()->id)->update(['image' => $saveFile]);
        }
        if ($request->type == "my_file2") {
            $business = Business::where("user_id", auth()->user()->id)->update(['cover_img' => $saveFile]);
        }


        return $saveFile;
    }


    public function new_locations_save(Request $request)
    {



        $businessDetail = [];
        $input = $request->input();


        $business = Business::where("user_id", auth()->user()->id)->first();

        $check = 0;

        // dd($check,$business);
        //2


        $delete = BusinessDetails::where("business_id", $business->id)->delete();

        if (isset($input['new_same_address'])) {
            $values['business_id'] = $business->id;
            $values['address'] = $business->business_address;
            $values['lat'] = $business->lat;
            $values['lon'] = $business->lon;

            $business_detail = $this->get_address($business->business_address);


            if ($business_detail['status'] != "OK") {
                $error = ["Business" => array("No Address Found")];
                return response()->json([
                    "errors" => $error
                ], 400);

            }

            $values['country'] = $business_detail['country'];
            $values['city'] = $business_detail['city'];


        }
        if (isset($input['new_address'])) {
            try {
                $business_detail = $this->get_address($request->new_address);

                if ($business_detail['status'] != "OK") {
                    $error = ["Business" => array("No Address Found")];
                    return response()->json([
                        "errors" => $error
                    ], 400);
                }

                $formatted_address = $business_detail['candidates'][0]['formatted_address'];

                $lat = $business_detail['candidates'][0]['geometry']['location']['lat'];
                $lon = $business_detail['candidates'][0]['geometry']['location']['lng'];
            } catch (\Exception $e) {

                $error = ["Business" => array("No Address Found")];
                return response()->json([
                    "errors" => $error
                ], 400);
            }

            $values['address'] = $formatted_address;
            $values['lat'] = $lat;
            $values['lon'] = $lon;
            $values['country'] = $business_detail['country'];
            $values['city'] = $business_detail['city'];
        }
        $newData = $this->newGetdayslocation($input);
        $days = $newData['days'];
        $close = $newData['close_time'];
        $open = $newData['open_time'];
        $values['open_time'] = json_encode($open);
        $values['close_time'] = json_encode($close);
        $values['open_days'] = json_encode($days);
        $values['business_id'] = $business->id;


        $businessDetail[] = BusinessDetails::create($values);
        $check += 1;
        $values = null;


        if ($check < 3 && $business->plan == 2) {

            if ($input['exist_2'] == "true") {
                if (isset($input['same_address_2'])) {

                    $values['business_id'] = $business->id;
                    $values['address'] = $business->business_address;
                    $values['lat'] = $business->lat;
                    $values['lon'] = $business->lon;


                    $business_detail = $this->get_address($request->same_address_2);


                    if ($business_detail['status'] != "OK") {
                        $error = ["Business" => array("No Address Found")];
                        return response()->json([
                            "errors" => $error
                        ], 400);

                    }

                    $values['country'] = $business_detail['country'];
                    $values['city'] = $business_detail['city'];

                }

                if (isset($input['address_2'])) {

                    // start
                    try {

                        $business_detail = $this->get_address($request->address_2);


                        if ($business_detail['status'] != "OK") {
                            $error = ["Business" => array("No Address Found")];
                            return response()->json([
                                "errors" => $error
                            ], 400);

                        }
                        $formatted_address = $business_detail['candidates'][0]['formatted_address'];


                        $lat = $business_detail['candidates'][0]['geometry']['location']['lat'];
                        $lon = $business_detail['candidates'][0]['geometry']['location']['lng'];


                    } catch (\Exception $e) {

                        $error = ["Business" => array("No Address Found")];
                        return response()->json([
                            "errors" => $error
                        ], 400);
                    }

                    // end

                    $values['address'] = $formatted_address;
                    $values['lat'] = $lat;
                    $values['lon'] = $lon;
                    $values['country'] = $business_detail['country'];
                    $values['city'] = $business_detail['city'];
                }

                // $values['country']="pakistan";
                // $values['city']="grw";
                $data2 = $this->getdayslocation2($input);
                $days = $data2['days2'];

                $close = $data2['close_time2'];
                $open = $data2['open_time2'];
                $values['open_time'] = json_encode($open);
                $values['close_time'] = json_encode($close);
                $values['open_days'] = json_encode($days);
                $values['business_id'] = $business->id;


                $businessDetail[] = BusinessDetails::create($values);
                $check += 1;
                $values = null;
            }


            // }

            // return response()->json([
            //     "business"=>$businessDetail
            //  ],200);


        } else {
            return response()->json([
                "Limit" => "Reached"
            ], 200);

        }


        //3
        // dd($check,$business->plan);
        if ($check < 3 && $business->plan == 2) {

            if ($input['exist_3'] == "true") {

                // start
                try {

                    $business_detail = $this->get_address($request->address_3);


                    if ($business_detail['status'] != "OK") {
                        $error = ["Business" => array("No Address Found")];
                        return response()->json([
                            "errors" => $error
                        ], 400);

                    }
                    $formatted_address = $business_detail['candidates'][0]['formatted_address'];


                    $lat = $business_detail['candidates'][0]['geometry']['location']['lat'];
                    $lon = $business_detail['candidates'][0]['geometry']['location']['lng'];


                } catch (\Exception $e) {

                    $error = ["Business" => array("No Address Found")];
                    return response()->json([
                        "errors" => $error
                    ], 400);
                }

                // end

                $values['address'] = $formatted_address;
                $values['lat'] = $lat;
                $values['lon'] = $lon;
                $values['country'] = $business_detail['country'];
                if ($business_detail['city']) {
                    $values['city'] = $business_detail['city'];
                } else {
                    $values['city'] = "Not Found";
                }


                // $values['country']="pakistan";
                // $values['city']="grw";
                $data3 = $this->getdayslocation3($input);
                $days = $data3['days3'];
                $close = $data3['close_time3'];
                $open = $data3['open_time3'];
                $values['open_time'] = json_encode($open);
                $values['close_time'] = json_encode($close);
                $values['open_days'] = json_encode($days);
                $values['business_id'] = $business->id;
// dd($values);
                $businessDetail[] = BusinessDetails::create($values);
            }


            // }

            return response()->json([
                "plan" => $business->plan,
                "business" => $businessDetail
            ], 200);


        } else {
            return response()->json([
                "Limit" => "Reached"
            ], 200);

        }


    }

    public function newGetdayslocation($input)
    {
        $days = [];
        $open_time = [];
        $close_time = [];


        if (isset($input['new_monday_open_close']) && $input['new_monday_open_close'] == "open") {
            $days[] = "Monday";
            $open_time[] = $input['new_monday_open_time'];
            $close_time[] = $input['new_monday_close_time'];

        } else {
            $days[] = "Monday";
            $open_time[] = null;
            $close_time[] = null;
        }

        if (isset($input['new_tuesday_open_close']) && $input['new_tuesday_open_close'] == "open") {
            $days[] = "Tuesday";
            $open_time[] = $input['new_tuesday_open_time'];
            $close_time[] = $input['new_tuesday_close_time'];

        } else {
            $days[] = "Tuesday";
            $open_time[] = null;
            $close_time[] = null;
        }

        if (isset($input['new_wednesday_open_close']) && $input['new_wednesday_open_close'] == "open") {
            $days[] = "Wednesday";
            $open_time[] = $input['new_wednesday_open_time'];
            $close_time[] = $input['new_wednesday_close_time'];
        } else {
            $days[] = "Wednesday";
            $open_time[] = null;
            $close_time[] = null;
        }

        if (isset($input['new_thursday_open_close']) && $input['new_thursday_open_close'] == "open") {
            $days[] = "Thursday";
            $open_time[] = $input['new_thrusday_open_time'];
            $close_time[] = $input['new_thrusday_close_time'];

        } else {
            $days[] = "Thursday";
            $open_time[] = null;
            $close_time[] = null;
        }

        if (isset($input['new_friday_open_close']) && $input['new_friday_open_close'] == "open") {
            $days[] = "Friday";
            $open_time[] = $input['new_friday_open_time'];
            $close_time[] = $input['new_friday_close_time'];

        } else {
            $days[] = "Friday";
            $open_time[] = null;
            $close_time[] = null;
        }

        if (isset($input['new_saturday_close_time']) && $input['new_saturday_open_close'] == "open") {
            $days[] = "Saturday";
            $open_time[] = $input['new_saturday_open_time'];
            $close_time[] = $input['new_saturday_close_time'];

        } else {
            $days[] = "Saturday";
            $open_time[] = null;
            $close_tim[] = null;
        }

        if (isset($input['new_sunday_open_close']) && $input['new_sunday_open_close'] == "open") {
            $days[] = "Sunday";
            $open_time[] = $input['new_sunday_open_time'];
            $close_time[] = $input['new_sunday_close_time'];
        } else {
            $days1[] = "Sunday";
            $open_time[] = null;
            $close_time[] = null;
        }
        $object = [];
        $object['days'] = $days;
        $object['open_time'] = $open_time;
        $object['close_time'] = $close_time;

        return $object;

    }


    public function getdayslocation($input)
    {
        $days1 = [];
        $open_time1 = [];
        $close_time1 = [];


        if (isset($input['monday_open_close1']) && $input['monday_open_close1'] == "open") {
            $days1[] = "Monday";
            $open_time1[] = $input['monday_open_time1'];
            $close_time1[] = $input['monday_close_time1'];

        } else {
            $days1[] = "Monday";
            $open_time1[] = null;
            $close_time1[] = null;
        }

        if (isset($input['tuesday_open_close1']) && $input['tuesday_open_close1'] == "open") {
            $days1[] = "Tuesday";
            $open_time1[] = $input['tuesday_open_time1'];
            $close_time1[] = $input['tuesday_close_time1'];

        } else {
            $days1[] = "Tuesday";
            $open_time1[] = null;
            $close_time1[] = null;
        }

        if (isset($input['wednesday_open_close1']) && $input['wednesday_open_close1'] == "open") {
            $days1[] = "Wednesday";
            $open_time1[] = $input['wednesday_open_time1'];
            $close_time1[] = $input['wednesday_close_time1'];
        } else {
            $days1[] = "Wednesday";
            $open_time1[] = null;
            $close_time1[] = null;
        }

        if (isset($input['thursday_open_close1']) && $input['thursday_open_close1'] == "open") {
            $days1[] = "Thursday";
            $open_time1[] = $input['thrusday_open_time1'];
            $close_time1[] = $input['thrusday_close_time1'];

        } else {
            $days1[] = "Thursday";
            $open_time1[] = null;
            $close_time1[] = null;
        }

        if (isset($input['friday_open_close1']) && $input['friday_open_close1'] == "open") {
            $days1[] = "Friday";
            $open_time1[] = $input['friday_open_time1'];
            $close_time1[] = $input['friday_close_time1'];

        } else {
            $days1[] = "Friday";
            $open_time1[] = null;
            $close_time1[] = null;
        }

        if (isset($input['saturday_close_time1']) && $input['saturday_open_close1'] == "open") {
            $days1[] = "Saturday";
            $open_time1[] = $input['saturday_open_time1'];
            $close_time1[] = $input['saturday_close_time1'];

        } else {
            $days1[] = "Saturday";
            $open_time1[] = null;
            $close_time1[] = null;
        }

        if (isset($input['sunday_open_close1']) && $input['sunday_open_close1'] == "open") {
            $days1[] = "Sunday";
            $open_time1[] = $input['sunday_open_time1'];
            $close_time1[] = $input['sunday_close_time1'];
        } else {
            $days1[] = "Sunday";
            $open_time1[] = null;
            $close_time1[] = null;
        }
        $object = [];
        $object['days'] = $days1;
        $object['open_time'] = $open_time1;
        $object['close_time'] = $close_time1;

        return $object;

    }

    public function getdayslocation2($input)
    {
        $days2 = [];
        $open_time2 = [];
        $close_time2 = [];


        if (isset($input['monday_open_close2']) && $input['monday_open_close2'] == "open") {
            $days2[] = "Monday";
            $open_time2[] = $input['monday_open_time2'];
            $close_time2[] = $input['monday_close_time2'];

        } else {
            $days2[] = "Monday";
            $open_time2[] = null;
            $close_time2[] = null;
        }

        if (isset($input['tuesday_open_close2']) && $input['tuesday_open_close2'] == "open") {
            $days2[] = "Tuesday";
            $open_time2[] = $input['tuesday_open_time2'];
            $close_time2[] = $input['tuesday_close_time2'];

        } else {
            $days2[] = "Tuesday";
            $open_time2[] = null;
            $close_time2[] = null;
        }

        if (isset($input['wednesday_open_close2']) && $input['wednesday_open_close2'] == "open") {
            $days2[] = "Wednesday";
            $open_time2[] = $input['wednesday_open_time2'];
            $close_time2[] = $input['wednesday_close_time2'];
        } else {
            $days2[] = "Wednesday";
            $open_time2[] = null;
            $close_time2[] = null;
        }

        if (isset($input['thursday_open_close2']) && $input['thursday_open_close2'] == "open") {
            $days2[] = "Thursday";
            $open_time2[] = $input['thrusday_open_time2'];
            $close_time2[] = $input['thrusday_close_time2'];

        } else {
            $days2[] = "Thursday";
            $open_time2[] = null;
            $close_time2[] = null;
        }

        if (isset($input['friday_open_close2']) && $input['friday_open_close2'] == "open") {
            $days2[] = "Friday";
            $open_time2[] = $input['friday_open_time2'];
            $close_time2[] = $input['friday_close_time2'];

        } else {
            $days2[] = "Friday";
            $open_time2[] = null;
            $close_time2[] = null;
        }

        if (isset($input['saturday_close_time2']) && $input['saturday_open_close2'] == "open") {
            $days2[] = "Saturday";
            $open_time2[] = $input['saturday_open_time2'];
            $close_time2[] = $input['saturday_close_time2'];

        } else {
            $days2[] = "Saturday";
            $open_time2[] = null;
            $close_time2[] = null;
        }

        if (isset($input['sunday_open_close2']) && $input['sunday_open_close2'] == "open") {
            $days2[] = "Sunday";
            $open_time2[] = $input['sunday_open_time2'];
            $close_time2[] = $input['sunday_close_time2'];
        } else {
            $days2[] = "Sunday";
            $open_time2[] = null;
            $close_time2[] = null;
        }
        $object = [];
        $object['days2'] = $days2;
        $object['open_time2'] = $open_time2;
        $object['close_time2'] = $close_time2;

        return $object;

    }

    public function getdayslocation3($input)
    {
        $days3 = [];
        $open_time3 = [];
        $close_time3 = [];


        if (isset($input['monday_open_close3']) && $input['monday_open_close3'] == "open") {
            $days3[] = "Monday";
            $open_time3[] = $input['monday_open_time3'];
            $close_time3[] = $input['monday_close_time3'];

        } else {
            $days3[] = "Monday";
            $open_time3[] = null;
            $close_time3[] = null;
        }

        if (isset($input['tuesday_open_close3']) && $input['tuesday_open_close3'] == "open") {
            $days3[] = "Tuesday";
            $open_time3[] = $input['tuesday_open_time3'];
            $close_time3[] = $input['tuesday_close_time3'];

        } else {
            $days3[] = "Tuesday";
            $open_time3[] = null;
            $close_time3[] = null;
        }

        if (isset($input['wednesday_open_close3']) && $input['wednesday_open_close3'] == "open") {
            $days3[] = "Wednesday";
            $open_time3[] = $input['wednesday_open_time3'];
            $close_time3[] = $input['wednesday_close_time3'];
        } else {
            $days3[] = "Wednesday";
            $open_time3[] = null;
            $close_time3[] = null;
        }

        if (isset($input['thursday_open_close3']) && $input['thursday_open_close3'] == "open") {
            $days3[] = "Thursday";
            $open_time3[] = $input['thrusday_open_time3'];
            $close_time3[] = $input['thrusday_close_time3'];

        } else {
            $days3[] = "Thursday";
            $open_time3[] = null;
            $close_time3[] = null;
        }

        if (isset($input['friday_open_close3']) && $input['friday_open_close3'] == "open") {
            $days3[] = "Friday";
            $open_time3[] = $input['friday_open_time3'];
            $close_time3[] = $input['friday_close_time3'];

        } else {
            $days3[] = "Friday";
            $open_time3[] = null;
            $close_time3[] = null;
        }

        if (isset($input['saturday_close_time3']) && $input['saturday_open_close3'] == "open") {
            $days3[] = "Saturday";
            $open_time3[] = $input['saturday_open_time3'];
            $close_time3[] = $input['saturday_close_time3'];

        } else {
            $days3[] = "Saturday";
            $open_time3[] = null;
            $close_time3[] = null;
        }

        if (isset($input['sunday_open_close3']) && $input['sunday_open_close3'] == "open") {
            $days3[] = "Sunday";
            $open_time3[] = $input['sunday_open_time3'];
            $close_time3[] = $input['sunday_close_time3'];
        } else {
            $days3[] = "Sunday";
            $open_time3[] = null;
            $close_time3[] = null;
        }
        $object = [];
        $object['days3'] = $days3;
        $object['open_time3'] = $open_time3;
        $object['close_time3'] = $close_time3;

        return $object;

    }


    public function send_tags(Request $request)
    {

        $input = $request->input();
        $business_detail = null;
        unset($input['_token']);
        if (isset($input['lat'])) {
            unset($input['lat']);
        }
        if (isset($input['lon'])) {
            unset($input['lon']);
        }


        try {
            foreach ($input as $key => $value) {

                $business_detail = $this->get_address($input[$key], 1);
             
                //
                if ($business_detail['status'] == "OK") {

                    $formatted_address = $business_detail['candidates'][0]['formatted_address'];
                    $lat = $business_detail['candidates'][0]['geometry']['location']['lat'];
                    $lon = $business_detail['candidates'][0]['geometry']['location']['lng'];


                } else {
                  
                    $error = ["Business" => array("No Address Found.")];
                    $output = response()->json([
                        "errors" => $error
                    ], 400);
                }


            }


        } catch (\Exception $e) {

            $error = ["Business" => array("No Address Found")];
            $output = response()->json([
                "errors" => $e->getMessage()
            ], 400);
        }


        $data['lat'] = $lat;
        $data['lon'] = $lon;
        $data['business_address'] = $formatted_address;


        $business = Business::where("user_id", Auth()->user()->id)
            ->update(["extra_info" => $data]);
        $business = Business::where("user_id", Auth()->user()->id)->first();
        

        $output = response()->json([
            "business" => $business
        ], 200);
        return $output;

    }

    public function get_choose_plan(Request $request)
    {
        $business = Business::where("user_id", Auth()->user()->id)->first();
        $plan['id'] = $business->plan;
        $location = json_decode($business->extra_info);

        if (property_exists($location, "send_location")) {

            $plan['send_location'] = $location->send_location;
        }

        if (property_exists($location, "search_location2")) {
            $plan['send_location'] = $location->search_location2;
        }

        if ($business->plan == 2) {
            $plan['description'] = "Premium - Monthly Billing";
        }
        if ($business->plan == 4) {
            $plan['description'] = "Premium - Anually Billing";
        }
        if ($business->plan == 1) {
            $plan['description'] = "Baisc - Monthly Billing";
        }
        if ($business->plan == 3) {
            $plan['description'] = "Basic - Anually Billing";
        }
        $plan['price'] = "£20";
        $plan['total'] = "£50";
        return response()->json([
            "plan" => $plan
        ], 200);
    }

    public function finished()
    {
        $user = User::where( "id", Auth()->user()->id )
            ->update(["account_status" => "pending"]);
            return response()->json([
                "update" => $user
            ], 200);
    }

    public function end(Request $request)
    {
        // $user = User::where([ ["id", Auth()->user()->id], ["account_status", "!-", "active"] ])
        //     ->update(["account_status" => "pending"]);
        //  $user = User::where( "id", Auth()->user()->id )
        //     ->update(["account_status" => "pending"]);
        Auth::logout();
        return redirect()->route("login");
        // ->withSuccess("Setup Complete!");
    }


    public function paid(Request $request)
    { 
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try
        {
            $amount = '4.99';
            $charge = Charge::create([
                'amount' => $amount * 100,
                'currency' => 'eur',
                'receipt_email' => $request->email,
                'source' => $request->token,
            ]);


            $business = Business::where("user_id", Auth()->user()->id)
                ->update(['paid' => 1]);

            return response()->json(['result'=>'success']);
        }
        catch(\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            return response()->json(['result'=>'error','message'=>$e->getError()->message]);

//            return $e->getError()->message;

        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
//            return $e->getError()->message;
            return response()->json(['result'=>'error','message'=>$e->getError()->message]);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
//            return $e->getError()->message;
            return response()->json(['result'=>'error','message'=>$e->getError()->message]);

        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
//            return $e->getError()->message;
            return response()->json(['result'=>'error','message'=>'Server Error']);

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
//            return $e->getError()->message;
            return response()->json(['result'=>'error','message'=>$e->getError()->message]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
//            return $e->getError()->message;
            return response()->json(['result'=>'error','message'=>$e->getError()->message]);

        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
//            return $e->getError()->message;
            return response()->json(['result'=>'error','message'=>$e->getError()->message]);

        }




    }


    public function get_address($data, $check = 0)
    {

        $data = str_replace(" ", "%20", $data);
        $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $data . "&inputtype=textquery&fields=formatted_address,geometry&key=" . ENV("GOOGLE_MAP_KEY");


        $client = new \GuzzleHttp\Client(['verify' => false]);

        $requestCreate = $client->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],

            ]
        );

        $response = $requestCreate->getBody();
//        $response = json_decode($response);


//        $curl = curl_init();
//
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => $url,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//        ));
//
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);


        $response = json_decode($response, true);


        if ($check == 0) {
            $lat = $response['candidates'][0]['geometry']['location']['lat'];
            $lon = $response['candidates'][0]['geometry']['location']['lng'];

            $result = $this->get_city_country($lat, $lon);
            $response['city'] = $result['city'];
            $response['country'] = $result['country'];
        }


        return $response;


    }

    public function get_city_country($lat, $lon)
    {

        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "," . $lon . "&key=" . ENV("GOOGLE_MAP_KEY");
//        $curl = curl_init();
//
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => $url,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);

        $client = new \GuzzleHttp\Client(['verify' => false]);

        $requestCreate = $client->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],

            ]
        );

        $response = $requestCreate->getBody();

        $response = json_decode($response, true);
        $country = null;
        $city = null;


        foreach ($response['results'][0]['address_components'] as $addressPart) {
            if ((in_array('locality', $addressPart['types'])) && (in_array('political', $addressPart['types'])))
                $city = $addressPart['long_name'];
            else if ((in_array('administrative_area_level_1', $addressPart['types'])) && (in_array('political', $addressPart['types'])))
                $state = $addressPart['long_name'];
            else if ((in_array('country', $addressPart['types'])) && (in_array('political', $addressPart['types'])))
                $country = $addressPart['long_name'];

        }


        return array("city" => $city, "country" => $country);


    }


}
