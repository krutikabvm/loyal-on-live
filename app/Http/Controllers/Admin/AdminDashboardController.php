<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plans;
use App\Models\Business;
use App\Models\Notifications;
use App\Models\Loyalty_Scheme;
use App\Models\Loyalty_location;
use App\Models\Customer_Loyalty;
use App\Models\BusinessDetails;
use Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Session;
use App\Models\UserAppSettings;
class AdminDashboardController extends Controller
{
    //get all business
    public function business(){
        $business =Business::select("business.id","business.image","business.business_name","business.plan","users.delete","users.created_at","users.account_status")
        ->join("users","business.user_id","users.id")
        ->where("users.account_status","active")
        ->where("users.type",2)
        ->where("business.verify","success")
        ->orderby("business.id","ASC")
        ->paginate(10);
        foreach ($business as $key => $value) {
            $value->loyality_cards=Loyalty_Scheme::where("business_id",$value->id)->count();
            $value->customers=Customer_Loyalty::where("business_id",$value->id)->count();
            $business[$key] = $value;
        }

        $business_reviews =Business::select("business.id","business.image","business.business_name","business.plan","users.delete","users.created_at","users.account_status")
        ->join("users","business.user_id","users.id")
        ->where("users.type",2)
        ->where("users.account_status","pending")
        ->orderby("business.id","DESC")
        ->paginate(1000);
        foreach ($business_reviews as $key => $value) {
            $value->loyality_cards=Loyalty_Scheme::where("business_id",$value->id)->count();
            $value->customers=Customer_Loyalty::where("business_id",$value->id)->count();
            $business_reviews[$key] = $value;
        }


        return view("admin_dashboard.business")->with(array("business"=>$business,"business_reviews"=> $business_reviews ));
    }
    //get all searches related to the business
    public function business_search(Request $request){
        $search = $request->input('search');
        $business =Business::select("business.id","business.image","business.business_name","business.plan","users.delete","users.created_at")
        ->join("users","business.user_id","users.id")
        ->where([["users.type",2], ["business.business_name",'LIKE', '%'.$search.'%'] ])
        ->orderby("business.id","ASC")
        ->paginate(1000);
        foreach ($business as $key => $value) {
            $value->loyality_cards=Loyalty_Scheme::where("business_id",$value->id)->count();
            $value->customers=Customer_Loyalty::where("business_id",$value->id)->count();
            $business[$key] = $value;
        }

        return view("admin_dashboard.business_search")->with("business",$business);
    }
    //get signle business details
    public function business_details($id){
        $id = decrypt($id);
        $business_details = Business::join("users","business.user_id","users.id")
        ->where("business.id",$id)
        ->select("business.*","users.id as user_id","users.delete","users.account_status","users.account_status","users.activation_code")->first();
        $loyality_cards=Loyalty_Scheme::where("business_id",$id)->get();
        $customers=Customer_Loyalty::where([ ["business_id",$id],["collected_stamps","!=",0] ])->count();

        $business_locations=Business::join("business_details","business_details.business_id","business.id")
        ->where("business.id",$id)
        ->select("business_details.*")->get();
        foreach($business_locations as $business_location)
        if($business_location){
         $open_timing=$this->handle_days($business_location->open_days,$business_location->open_time,$business_location->close_time);
         $open_timings[]=$open_timing['timings'];
        }else{
          $open_timings[]=array();
        }


        $business_reviews =Business::select("business.id","business.image","business.business_name","business.plan","users.delete","users.created_at","users.account_status")
        ->join("users","business.user_id","users.id")
        ->where("users.type",2)
        ->where("users.account_status","pending")
        ->orderby("business.id","DESC")
        ->paginate(1000);
        foreach ($business_reviews as $key => $value) {
            $value->loyality_cards=Loyalty_Scheme::where("business_id",$value->id)->count();
            $value->customers=Customer_Loyalty::where("business_id",$value->id)->count();
            $business_reviews[$key] = $value;
        }
        return view("admin_dashboard.business_details")->with(array('business_details'=>$business_details,'loyality_cards'=>$loyality_cards,'customers' => $customers,"times"=>@$open_timings,"locations"=>$business_locations,'business_reviews'=>$business_reviews));

    }
    //get all customers
    public function customers(){
        $business =User::where("type",3)->where('email_verified_at','!=',NULL)->orderby("id","DESC")->paginate(5);
        foreach ($business as $key => $value) {
            $value->loyality_cards=Customer_Loyalty::where("customer_id",$value->id)->count();
            $business[$key] = $value;
        }

        return view("admin_dashboard.customers")->with("business",$business);
    }
     //get all customers
    public function customer_search(Request $request){
        $search = $request->input('search');
        $business =User::where([ ["type",3], ["name",'LIKE', '%'.$search.'%'] ])->orderby("id","DESC")->paginate(1000);
        foreach ($business as $key => $value) {
            $value->loyality_cards=Customer_Loyalty::where("customer_id",$value->id)->count();
            $business[$key] = $value;
        }

        return view("admin_dashboard.customer_search")->with("business",$business);
    }
    //get signle customer details
    public function customer_details($id){
        $id = decrypt($id);
        $customer = User::find($id);
        $customer->cards_count=Customer_Loyalty::where("customer_id",@$customer->id)->count();
        $loyality_cards = Customer_Loyalty::join('loyalty_scheme','loyalty_scheme.id','customer_loyalty.loyalty_id')->join('business','business.id','customer_loyalty.business_id')
                          ->where('customer_loyalty.customer_id',$id)->select('loyalty_scheme.*','customer_loyalty.collected_stamps','customer_loyalty.claim','business.image','business.business_name')->get();
        return view("admin_dashboard.customer_details")->with(array("customer"=>$customer,"loyality_cards"=>$loyality_cards));

    }
    // customer image
     public function uploadCusImg(Request $request)
    {

        $userBussiness = User::where('id', $request->get('customer_id'))->first();
        if ($request->has('profileImg')) {
            $imageName = time().'.'.$request->profileImg->extension();
            $userBussiness ->img = 'images/'.$imageName;
            $request->profileImg->move(public_path('images/'), $imageName);
        }
        $userBussiness -> save();

        return json_encode(["msg"=>"Image updated successfully"]);
    }
    //push_notification
    public function push_notification(){

        return view("admin_dashboard.push_notification");

    }
    // billing
    public function billing(Request $request){
       $business_reviews =Business::select("business.id","business.image","business.business_name","business.plan","users.delete","users.created_at","users.account_status")
        ->join("users","business.user_id","users.id")
        ->where("users.type",2)
        ->where("users.account_status","pending")
        ->orderby("business.id","DESC")
        ->paginate(1000);
        foreach ($business_reviews as $key => $value) {
            $value->loyality_cards=Loyalty_Scheme::where("business_id",$value->id)->count();
            $value->customers=Customer_Loyalty::where("business_id",$value->id)->count();
            $business_reviews[$key] = $value;
        }
        return view("admin_dashboard.billing")->with("business_reviews",$business_reviews);
    }
    // admin logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route("login");
    }
    //loyality_card_insights
    public function loyality_card_insights($id){
        $id = decrypt($id);
        $business_details = Business::join("users","business.user_id","users.id")
        ->where("business.id",$id)
        ->select("business.*","users.id as user_id","users.delete","users.activation_code")->first();

        $loyality = Loyalty_Scheme::where("business_id",$id)->get();
        foreach ($loyality as $key => $value) {
        	$value->customer_loyalty = Customer_Loyalty::join("users","customer_loyalty.customer_id","users.id")->where("customer_loyalty.loyalty_id",$value->id)->select("users.name","customer_loyalty.collected_stamps")->get();

        	$loyality[$key] = $value;
        }
        //dd($loyality);
        //total customer
        $total_customers=Customer_Loyalty::where("business_id",$id)->where(function($q){
            return $q->where("total_collected_stamps","!=",0)->where("collected_stamps","!=",0);
        })->where('claim',0)->count();
        //stamps collected
        $total_stamps_collected=Customer_Loyalty::where("business_id",$id)->withTrashed()->sum('total_collected_stamps');
        //Completed Loyalty Cards
        $complete_loyality_card= DB::table('customer_loyalty_claims')->where("business_id", $id)->sum('claim');
        //Customers
        $male = 0; $female = 0; $others=0;$ages = array(0,0,0,0,0,0,0);
        $customers=Customer_Loyalty::where("business_id",$id)->get();
        //daily stamps collected
        $daily_stamps_collected = array(0,0,0,0,0,0,0);

        foreach ($customers as $key => $customer) {
        	if(!empty($customer)){
        		$user = User::find($customer->customer_id);
        		if(!empty($user))
        		{
        		    if($user->gender == "Male" OR $user->gender == "male"){
        			$male = $male + 1;
        		}elseif($user->gender == "Female" OR $user->gender == "female"){
        			$female = $female + 1;
        		}else{
        			$others = $others + 1;
        		}
        		$age = \Carbon\Carbon::parse($user->dob)->age;
        		if($age >= 15 AND $age <= 24 ){
        			$ages[0] = $ages[0] + 1;
        		}elseif($age >= 25 AND $age <= 34 ){
        			$ages[1] = $ages[1] + 1;
        		}elseif($age >= 35 AND $age <= 44 ){
        			$ages[2] = $ages[2] + 1;
        		}elseif($age >= 45 AND $age <= 54 ){
        			$ages[3] = $ages[3] + 1;
        		}elseif($age >= 55 AND $age <= 64 ){
        			$ages[4] = $ages[4] + 1;
        		}elseif($age >= 66 AND $age <= 74 ){
        			$ages[5] = $ages[5] + 1;
        		}elseif($age >= 75 ){
        			$ages[6] = $ages[6] + 1;
        		}

        		if(date('l',strtotime($customer->created_at) ) == 'Monday' ){
		           $daily_stamps_collected[0] = $daily_stamps_collected[0] + $customer->collected_stamps;
		       }
		       if(date('l',strtotime($customer->created_at) ) == 'Tuesday' ){
		            $daily_stamps_collected[1] = $daily_stamps_collected[1] + $customer->collected_stamps;
		       }
		       if(date('l',strtotime($customer->created_at) ) == 'Wednesday' ){
		            $daily_stamps_collected[2] = $daily_stamps_collected[2] + $customer->collected_stamps;
		       }
		       if(date('l',strtotime($customer->created_at) ) == 'Thursday' ){
		            $daily_stamps_collected[3] =  $daily_stamps_collected[3] + $customer->collected_stamps;
		       }
		       if(date('l',strtotime($customer->created_at) ) == 'Friday' ){
		            $daily_stamps_collected[4] = $daily_stamps_collected[4] + $customer->collected_stamps;
		       }
		       if(date('l',strtotime($customer->created_at) ) == 'Saturday' ){
		            $daily_stamps_collected[5] = $daily_stamps_collected[5] + $customer->collected_stamps;
		       }if(date('l',strtotime($customer->created_at) ) == 'Sunday' ){
		            $daily_stamps_collected[6] = $daily_stamps_collected[6] + $customer->collected_stamps;
		       }
        		}

        	}
        }


        $gender = array($male,$female,$others);


       $business_reviews =Business::select("business.id","business.image","business.business_name","business.plan","users.delete","users.created_at","users.account_status")
        ->join("users","business.user_id","users.id")
        ->where("users.type",2)
        ->where("users.account_status","pending")
        ->orderby("business.id","DESC")
        ->paginate(1000);
        foreach ($business_reviews as $key => $value) {
            $value->loyality_cards=Loyalty_Scheme::where("business_id",$value->id)->count();
            $value->customers=Customer_Loyalty::where("business_id",$value->id)->count();
            $business_reviews[$key] = $value;
        }
        return view("admin_dashboard.loyality_card_insights")->with(array('business_details'=>$business_details,"loyality"=>$loyality,'total_customers'=>$total_customers,'total_stamps_collected'=>$total_stamps_collected,'daily_stamps_collected'=>$daily_stamps_collected,'business_reviews'=>$business_reviews,'complete_loyality_card'=>$complete_loyality_card,'gender'=>$gender ,'ages'=>$ages ));

    }

    public function index(Request $request){
        $customers=DB::table("customer_loyalty")
        ->join("business","business.id","customer_loyalty.business_id")
         ->where("business.user_id",Auth::user()->id)
        ->count();

         $stamps=DB::table("customer_loyalty")
        ->join("business","business.id","customer_loyalty.business_id")
         ->where("business.user_id",Auth::user()->id)
        ->sum("customer_loyalty.collected_stamps");

        $daily_stamps_collected = array(0,0,0,0,0,0,0);
        $stamps_data = DB::table("customer_loyalty")
        ->join("business","business.id","customer_loyalty.business_id")
         ->where("business.user_id",Auth::user()->id)
         ->select(DB::raw("(SUM(customer_loyalty.collected_stamps)) as count"),DB::raw("DAYNAME(customer_loyalty.created_at) as dayname"))
     // ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    ->whereYear('customer_loyalty.created_at', date('Y'))
    ->groupBy('dayname')
    ->get();
    foreach ($stamps_data as $key => $stamp) {
       if(date('l',strtotime($stamp->dayname) ) == 'Sunday' ){
            $daily_stamps_collected[0] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Monday' ){
            $daily_stamps_collected[1] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Tuesday' ){
            $daily_stamps_collected[2] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Wednesday' ){
            $daily_stamps_collected[3] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Thursday' ){
            $daily_stamps_collected[4] =  (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Friday' ){
            $daily_stamps_collected[5] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Saturday' ){
            $daily_stamps_collected[6] = (int) $stamp->count;
       }
    }
    //redeemed points every day
    $daily_redeemed_points = array(0,0,0,0,0,0,0);
    $redeem_points = DB::table("customer_loyalty")
    ->join("business","business.id","customer_loyalty.business_id")
     ->where("business.user_id",Auth::user()->id)
     ->where("customer_loyalty.claim",1)
     ->select(DB::raw("(SUM(customer_loyalty.collected_stamps)) as count"),DB::raw("DAYNAME(customer_loyalty.created_at) as dayname"))
     // ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    ->whereYear('customer_loyalty.created_at', date('Y'))
    ->groupBy('dayname')
    ->get();
    foreach ($redeem_points as $key => $stamp) {
       if(date('l',strtotime($stamp->dayname) ) == 'Sunday' ){
            $daily_redeemed_points[0] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Monday' ){
            $daily_redeemed_points[1] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Tuesday' ){
            $daily_redeemed_points[2] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Wednesday' ){
            $daily_redeemed_points[3] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Thursday' ){
            $daily_redeemed_points[4] =  (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Friday' ){
            $daily_redeemed_points[5] = (int) $stamp->count;
       }
       if(date('l',strtotime($stamp->dayname) ) == 'Saturday' ){
            $daily_redeemed_points[6] = (int) $stamp->count;
       }
    }

    $stamps_comp=DB::table("customer_loyalty")
    ->join("business","business.id","customer_loyalty.business_id")
    ->join("loyalty_scheme","loyalty_scheme.business_id","business.id")
     ->where("business.user_id",Auth::user()->id)
     ->where("customer_loyalty.collected_stamps","loyalty_scheme.number_stamps")
    ->groupBy('customer_loyalty.id')
    ->count();

 $business_location=Business::join("business_details","business_details.business_id","business.id")
        ->where("user_id",Auth::user()->id)
        ->select("business_details.*")->get();

     $business=Business::where("user_id",Auth::user()->id)->get();
        return view("business_dashboard.index")->with("data",array("daily_redeemed_points"=>$daily_redeemed_points,"daily_stamps_collected"=>$daily_stamps_collected,"customers"=>$customers,"stamps"=>$stamps,"comp"=>$stamps_comp))->with("locations",$business_location)->with("business",$business);

    }

    public function locations(Request $request){
        if(Auth::user()->delete == 1){
            return redirect()->route("business.account");
        }
        $business_locations=Business::join("business_details","business_details.business_id","business.id")
        ->where("user_id",Auth::user()->id)
        ->select("business_details.*")->get();
        foreach($business_locations as $business_location)
        if($business_location){
         $open_timing=$this->handle_days($business_location->open_days,$business_location->open_time,$business_location->close_time);
         $open_timings[]=$open_timing['timings'];
        }else{
          $open_timings[]=null;
        }


          return view("business_dashboard.location")->with("locations",$business_locations)->with("times",$open_timings);

    }

    public function profile(Request $request){
        // if account is cancelled redirect to account details
        if(Auth::user()->delete == 1){
            return redirect()->route("business.account");
        }
        $business=Business::join("business_details","business_details.business_id","business.id")
         ->where("user_id",Auth::user()->id)
        ->select("business.*")->first();
        if($business){
            $loyalties=Loyalty_Scheme::where("business_id",$business->id)->get()->toArray();

        }else{
            $loyalties=null;
        }
          return view("business_dashboard.profile")->with("business",$business)->with("loyalties",$loyalties);

    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $account_settings = DB::table("web_settings")->where('id',1)->first();
        return view("admin_dashboard.account-details")->with(array("user"=>$user,"account_settings"=>$account_settings) );
    }



    public function plan(Request $request){
        // // if account is cancelled redirect to account details
        // if(Auth::user()->delete == 1){
        //     return redirect()->route("business.account");
        // }
        $plans = Plans::all();


        return view("admin_dashboard.plans")->with(array("plans"=>$plans));
    }

    public function save_plan(Request $request){

        $plan_id = decrypt($request->get("id"));
        $plan = Plans::find($plan_id);
        $plan->plan_name = $request->get("plan_name");
        $plan->plan_features = serialize($request->get("features"));
        if(!empty($request->get("upcoming"))){
            $plan->upcoming_features = serialize($request->get("upcoming"));
        }
        $plan->plan_price = $request->get("plan_price");
        $plan->save();
        return redirect("admin/plan")->withSuccess("Plan Updated Sucessfully!");
    }
     public function handle_days($days,$open,$close){

     $days=json_decode($days);
     $open=json_decode($open);
     $close=json_decode($close);
     $current_open=null;
     $current_close=null;
    $timings=[];
    $current_day=date("l");
    // dd($current_day);
    // $current_day=strtolower($current_day);


        foreach( $days as $index => $value){
        $days=[];

        $days['day']=ucfirst($value);

        if ($open[$index]!=null && $close[$index] !=null){
              if($current_day==$value){
            $current_open=$open[$index];
            $current_close=$close[$index];

        }
            $days['status']="open";
            $days['open_time']=$open[$index];
            $days['close_time']=$close[$index];

        }else{
                $days['status']="close";
                $days['open_time']=null;
                $days['close_time']=null;
        }



           $timings[]=$days;
        }

        $obj['timings']=$timings;
        $obj['current_open_time']=$current_open;
         $obj['current_close_time']=$current_close;

      return $obj;


    }


    public function update_data(Request $request){

        $input=$request->input();
     
        // time
       

        if(isset($input['field']) && $input['field']=="time_table"){

            $data=$this->getdayslocation($input);
            $days=$data['days'];
            $close=$data['close_time'];
            $open=$data['open_time'];
            // $values['open_time']=json_encode($open);
            // $values['close_time']=json_encode($close);
            // $values['open_days']=json_encode($days);

            unset($input['table']);
            unset($input['field']);
            $id=$input['id'];
            unset($input['id']);
            if(isset($input['lat'])){
                if($id == 0){
                    BusinessDetails::create([
                        "business_id"=>$input['business_id'],"address"=>$input['locup'],"lat"=>$input['lat'],"lon"=>$input['lon'],"city"=>$input['city'],"country"=>$input['country'], "open_time"=>json_encode($open),"close_time"=>json_encode($close),"open_days"=>json_encode($days)
                    ]);

                }else{
                    BusinessDetails::where("id",$id)
                    ->update([
                       "address"=>$input['locup'],"lat"=>$input['lat'],"lon"=>$input['lon'],"city"=>$input['city'],"country"=>$input['country'], "open_time"=>json_encode($open),"close_time"=>json_encode($close),"open_days"=>json_encode($days)
                        ]);
                }
            }else{
                

                 if($id == 0){
                    BusinessDetails::create([
                        "business_id"=>$input['business_id'],"address"=>$input['locup'], "open_time"=>json_encode($open),"close_time"=>json_encode($close),"open_days"=>json_encode($days)
                 ]);

                }else{
                    BusinessDetails::where("id",$id)
             ->update([
                "address"=>$input['locup'], "open_time"=>json_encode($open),"close_time"=>json_encode($close),"open_days"=>json_encode($days)
                 ]);

                }

            }
             

            return $data;


        }

         if(isset($input['field']) && $input['field']=="number_stamps"){



            unset($input['table']);
            unset($input['field']);
            $id=$input['id'];
            unset($input['id']);

            $loyal_card = Loyalty_Scheme::where("id",$id)->update(['number_stamps'=>$input['number_stamps']]);
            if($loyal_card){
                return json_encode(["msg"=>"Loyality card Updated"]);
            }else{
                return json_encode(["msg"=>"Error occurs while updating loyality card "]);

            }

        }

         if(isset($input['field']) && $input['field']=="stamps_per_day"){



            unset($input['table']);
            unset($input['field']);
            $id=$input['id'];
            unset($input['id']);

            Loyalty_Scheme::where("id",$id)->update(['stamps_per_day'=>$input['stamps_per_day']]);


        }
        if(isset($input['field']) && $input['field']=="stamp_description"){



            unset($input['table']);
            unset($input['field']);
            $id=$input['id'];
            unset($input['id']);

            Loyalty_Scheme::where("id",$id)->update(['description'=>$input['stamp_description']]);


        }
        if(isset($input['field']) && $input['field']=="address"){
            unset($input['table']);
            unset($input['field']);
            $id=$input['id'];
            unset($input['id']);
             BusinessDetails::where("id",$id)
             ->update([
                 "address"=>$input['address'],"lat"=>$input['lat'],"lon"=>$input['lon']
                 ]);


        }

         if(isset($input['field']) && $input['field']=="business_address"){
            unset($input['table']);
            unset($input['field']);
            $id=$input['id'];
            unset($input['id']);
             Business::where("id",$id)
             ->update([
                 "business_address"=>$input['address'],"lat"=>$input['lat'],"lon"=>$input['lon']
                 ]);


        }

         if(isset($input['field'])  ){
             if($input['field']=="description"
             || $input['field']=="facebook_link"
             ||$input['field']=="instagram_link"){
                //  dd($input);
                unset($input['table']);
                $field=$input['field'];
                unset($input['field']);
                $id=$input['id'];
                unset($input['id']);
                 Business::where("id",$id)
                 ->update([
                     $field=>$input[$field]
                     ]);
             }


        }





        return $input;




    }


    public function update_pwd(Request $request){

        $old_pwd=$request->old_password;
        $new_pwd=$request->new_password;

        $hashedPassword = User::find(Auth::user()->id)->password;

if (Hash::check($old_pwd, $hashedPassword)) {
    $new_pwd = Hash::make($new_pwd);
    User::where("id",Auth::user()->id)->update(['password'=>$new_pwd]);
    return response()->json(['same'=>"yes"],200);
}else{
    return response()->json(['same'=>'no'],404);
}


    }

    public function update_profile(Request $request){

        $input=$request->input();

        User::where("id",Auth::user()->id)->update(['name'=>$input['name']]);

        $business=User::find($input['id']);
        if(isset($input['name'])){
            $business->name=$input['name'];
        }
        if(isset($input['email'])){
            $business->email=$input['email'];
        }
        $business->save();
        return $input;



    }

    public function getdayslocation($input){
        $days1=[];
        $open_time1=[];
        $close_time1=[];



        if(isset($input['monday_open_close1']) && $input['monday_open_close1']=="open"){
            $days1[]="Monday";
            $open_time1[]=$input['monday_open_time1'];
            $close_time1[]=$input['monday_close_time1'];

        }else{
            $days1[]="Monday";
            $open_time1[]=null;
            $close_time1[]=null;
        }

        if(isset($input['tuesday_open_close1']) && $input['tuesday_open_close1']=="open"){
            $days1[]="Tuesday";
            $open_time1[]=$input['tuesday_open_time1'];
            $close_time1[]=$input['tuesday_close_time1'];

        }
        else{
            $days1[]="Tuesday";
            $open_time1[]=null;
            $close_time1[]=null;
        }

        if(isset($input['wednesday_open_close1']) && $input['wednesday_open_close1']=="open"){
            $days1[]="Wednesday";
            $open_time1[]=$input['wednesday_open_time1'];
            $close_time1[]=$input['wednesday_close_time1'];
        }else{
            $days1[]="Wednesday";
            $open_time1[]=null;
            $close_time1[]=null;
        }

        if(isset($input['thursday_open_close1']) && $input['thursday_open_close1']=="open"){
            $days1[]="Thursday";
            $open_time1[]=$input['thrusday_open_time1'];
            $close_time1[]=$input['thrusday_close_time1'];

        }else{
            $days1[]="Thursday";
            $open_time1[]=null;
            $close_time1[]=null;
        }

        if(isset($input['friday_open_close1']) && $input['friday_open_close1']=="open"){
            $days1[]="Friday";
            $open_time1[]=$input['friday_open_time1'];
            $close_time1[]=$input['friday_close_time1'];

        }else{
            $days1[]="Friday";
            $open_time1[]=null;
            $close_time1[]=null;
        }

        if(isset($input['saturday_close_time1']) && $input['saturday_open_close1']=="open"){
            $days1[]="Saturday";
            $open_time1[]=$input['saturday_open_time1'];
            $close_time1[]=$input['saturday_close_time1'];

        }else{
            $days1[]="Saturday";
            $open_time1[]=null;
            $close_time1[]=null;
        }

        if(isset($input['sunday_open_close1']) && $input['sunday_open_close1']=="open"){
            $days1[]="Sunday";
            $open_time1[]=$input['sunday_open_time1'];
            $close_time1[]=$input['sunday_close_time1'];
        }else{
            $days1[]="Sunday";
            $open_time1[]=null;
            $close_time1[]=null;
        }
        $object=[];
        $object['days']=$days1;
        $object['open_time']=$open_time1;
        $object['close_time']=$close_time1;

        return $object;

    }

    public function update_plan(Request $request){

        $val=$request->plan;

        business::where("user_id",Auth::user()->id)->update(['plan'=>$val]);
        return json_encode("ok",200);

    }

    public function add_location(Request $request){

        $input=$request->input();
        $values['business_id']=$input['business_id'];
        $values['address']=$input['address'];
        $values['lat']=$input['lat'];
        $values['lon']=$input['lon'];
        $data=$this->getdayslocation($input);

        $values['open_days']=json_encode($data['days']);
        $values['close_time']=json_encode($data['close_time']);
        $values['open_time']=json_encode($data['open_time']);

        $count=DB::table("business")->join("business_details","business.id","business_details.business_id")
->where("business.user_id",auth()->user()->id)->count();
if($count<3){
    BusinessDetails::insert($values);
}


        return redirect()->back()->with('success','Location added successfully');

    }

    public function uploadImages(Request $request)
    {

        $userBussiness = Business::where('id', $request->get('business_id'))->first();

        if ($request->has('cardInput')) {

            $userBussinessLoyalty = Loyalty_Scheme::find($request->get('loyality_id'));
            $imageName = time().'.'.$request->cardInput->extension();
            $userBussinessLoyalty -> img = 'images/profile/'.$imageName;
            $request->cardInput->move(public_path('images/profile'), $imageName);
            $userBussinessLoyalty -> save();
        } else {
            if ($request->has('coverInput')) {
                $imageName = time().'.'.$request->coverInput->extension();
                $userBussiness -> cover_img = 'images/profile/'.$imageName;
                $request->coverInput->move(public_path('images/profile'), $imageName);
            }
            if ($request->has('profilePicInput')) {
                $imageName = time().'.'.$request->profilePicInput->extension();
                $userBussiness -> image = 'images/profile/'.$imageName;
                $request->profilePicInput->move(public_path('images/profile'), $imageName);
            }
            $userBussiness -> save();
        }

        if($request->get('useLogo')){
            $userBussinessLoyalty = Loyalty_Scheme::find($request->get('loyality_id'));
            $userBussinessLoyalty->img = $request->get('useLogo');
            $userBussinessLoyalty -> save();
        }

        // if(!File::exists($path)) {
        //     Storage::putFile('avatars', $request->file('avatar'));
        // }
        return json_encode(["msg"=>"updated"]);
    }
    public function UpdateScheme(Request $request){
        $input=$request->input();

        $loyalty_scheme = Loyalty_Scheme::find($request->get('loyal_id'));

        if(!empty($_FILES['newSchemeImg']['name']) ) {
            if ($request->has('newSchemeImg')) {
                $imageName = time().'.'.$request->newSchemeImg->extension();
                $img = 'images/profile/'.$imageName;
                $request->newSchemeImg->move(public_path('images/profile'), $imageName);
                $loyalty_scheme->img = @$img;
            }
        }
            $loyalty_scheme->description = $request->get('description');
            $loyalty_scheme->other_description = $request->get('other_description');
            $loyalty_scheme->number_stamps = $request->get('number_stamps');
            $loyalty_scheme -> save();
            return redirect("admin/business_details/".encrypt($request->get('business_id')))->withSuccess("Loyality card updated Sucessfully!");

    }
    // Delete Loyality card
    public function delete_loyality(Request $request){
        $id = $request->get('id');
        $del = Loyalty_Scheme::where('id',$id)->delete();
        return json_encode(["msg"=>"deleted"]);
    }
    // Delete Location
    public function delete_location(Request $request){
        $id = decrypt($request->get('id'));
        $del = BusinessDetails::where('id',$id)->delete();
        return json_encode(["msg"=>"deleted"]);
    }
    // Delete Location
    public function remove_image($id){
        $id = decrypt($id);
        $del = Loyalty_Scheme::where('id',$id)->update(['img'=>NUll]);
        return redirect("business/profile")->withSuccess("Loyality card image deleted Sucessfully!");
    }
    // cancel business account
    public function cancel_account($id){
        $user_id = decrypt($id);
        $del = User::where('id',$user_id)->update(['delete'=>1]);
        return redirect("admin/business")->withSuccess("Account Deactivated Sucessfully!");
    }
    // cancel business account
    public function active_account($id){
        $user_id = decrypt($id);

        $business = User::select('business.id as business_id')->where('users.id',$user_id)->join('business','users.id','=','business.user_id')->first();
        $code = rand(1000,9999);
        $del = User::where('id',$user_id)->update(['activation_code'=>$code]);
        Session::flash('code', $code);
        return redirect("admin/business_details/".encrypt($business->business_id));
    }
    // Web Settings on admin side
    public function update_settings(Request $request){
        $del = DB::table("web_settings")->where('id',1)->update(['terms_conditions'=>$request->get('settings') ]);
        return redirect("admin/account")->withSuccess("Terms and conditions updated successfully");

    }

    // for reactivating business account
    public function reactivate_account($id){
        $user_id = decrypt($id);
        $del = User::where('id',$user_id)->update(['delete'=>0]);
        return redirect("admin/business")->withSuccess("Account Reactivated Sucessfully!");
    }
    // cancel customer account
    public function cancel_customer_account($id){
        $user_id = decrypt($id);
        $del = User::where('id',$user_id)->update(['delete'=>1]);
        return redirect("admin/customers")->withSuccess("Account Deactivated Sucessfully!");
    }
    // for reactivating customer account
    public function reactivate_customer_account($id){
        $user_id = decrypt($id);
        $del = User::where('id',$user_id)->update(['delete'=>0]);
        return redirect("admin/customers")->withSuccess("Account Reactivated Sucessfully!");
    }
    //send push notification
    public function send_push(request $request){
        $img_url = "";
    	if(!empty($_FILES['notification_img']['name']) ) {
            if ($request->has('notification_img')) {
                $imageName = time().'.'.$request->notification_img->extension();
                $img = 'images/notifications/'.$imageName;
                $request->notification_img->move(public_path('images/notifications'), $imageName);
                $img_url = url('/images/notifications/'.$imageName);
            }
        }else{
        	$img = @$request->get('img_link');
            $img_url = @$request->get('img_link');
        }

        $notifications = new Notifications();
        $notifications->notification_title = @$request->get('notification_title');
        $notifications->notification_body = @$request->get('notification_body');
        $notifications->notification_img = @$img;
        $notifications->save();
        // push notification
        $title = @$request->get('notification_title');
        $message = @$request->get('notification_body');
        $user_data = array( "title" => $title,"body" => $message ,  'click_action'=>'FLUTTER_NOTIFICATION_CLICK','img_link'=>$img_url,'type'=>1);
        $users = User::join('user_app_settings','user_app_settings.user_id','users.id')->where("user_app_settings.notifications","on")->select('users.device_token','users.device_type')->get();
        $tokens = array();
        foreach ($users as $key => $user) {
            if(!empty($user->device_token)){
                $tmp['device_token'] = $user->device_token;
                $tmp['device_type'] = $user->device_type;
            }
            if(!empty($tmp)){
                array_push($tokens, $tmp);
            }
        }
        $this->sendNotification($title,$tokens,$user_data,$message);
        // push notification end

        return redirect("admin/push_notification")->withSuccess("Notification Send Sucessfully!");
    }
    // send push notification
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification($title,$fcm_token,$user_data,$message)
    {
        $SERVER_API_KEY = 'AAAAdo8yQ3M:APA91bEz2HHCdDNBRfozDzsLYgJXYJ_uxHDv-KBqJdirEFxRO6jZ0JcRi1X5k_4ub-rs3xMkUk7g7gKuH2kOhTTahGOMFnXVCX0lc2sDhAhs1TNVbqAWwpDu8fz6HZoO8QabarBtVDdG';
        foreach($fcm_token as $val){
            if($val['device_type'] == "android"){
                $data = array("to" => $val['device_token'],
                 "data"=>$user_data);

            }else{
                $data = array("to" => $val['device_token'],"notification" => [
                "title" => $title,
                "body" => $message ,
                ],
                "data"=>$user_data);
            }

            $data_string = json_encode($data);

            // echo "The Json Data : ".$data_string;

            $headers = array
            (
                 'Authorization: key=' .$SERVER_API_KEY,
                 'Content-Type: application/json'
            );

            $ch = curl_init();

            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);

            $result = curl_exec($ch);
            // echo "<pre>";print_r($result);die();
            curl_close ($ch);

        }
    }

    public function update_business_data(request $request){
        $business = Business::find($request->get('id'));
        $business->business_name = $request->get('b_name');
        $business->business_number = $request->get('phone');
        $business->business_address = $request->get('address');
        $business->description = $request->get('bio');
        $business->save();
        return redirect("admin/business_details/".encrypt($request->get('id')) )->withSuccess("Business details updated successfully");


    }

    public function update_status(request $request){
        $result = BusinessDetails::where("id",$request->id)->first();
        if($result->status == 1){
            $result->status  = 0;
            
        }else{
            $result->status  = 1;  
        }
         $result->save();
         
        return $result;

    }


}
