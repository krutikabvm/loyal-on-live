<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessDetails;
use App\Models\Customer_Loyalty;
use App\Models\Loyalty_Scheme;
use App\Models\Plans;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class BusinessDashboardController extends Controller
{
    //

    public function index(Request $request)
    {
        // if account is cancelled redirect to account details
        if (Auth::user()->delete == 1) {
            return redirect()->route("business.account");
        }
        // Get user bussiness
        $business = Business::where('user_id', Auth::user()->id)->first();
        //total customer
        $customers = Customer_Loyalty::where([["customer_loyalty.business_id", $business->id], ["customer_loyalty.collected_stamps", "!=", 0], ["customer_loyalty.total_collected_stamps", "!=", 0]])->withTrashed()->count();

        //stamps collected
        $stamps = Customer_Loyalty::where("business_id", $business->id)->withTrashed()->sum('total_collected_stamps');

        $daily_stamps_collected = array(0, 0, 0, 0, 0, 0, 0);
        $stamps_data = DB::table("customer_loyalty")
            ->join("business", "business.id", "customer_loyalty.business_id")
            ->where("business.user_id", Auth::user()->id)
            ->select(DB::raw("(SUM(IF(customer_loyalty.collected_stamps > 0, customer_loyalty.collected_stamps, customer_loyalty.total_collected_stamps))) as count"), DB::raw("DAYNAME(customer_loyalty.created_at) as dayname"))
             ->whereBetween(DB::raw('DATE_FORMAT(customer_loyalty.updated_at,"%Y-%m-%d")'), [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])
            ->whereYear('customer_loyalty.created_at', date('Y'))
            //->whereNotNull('deleted_at')
            ->groupBy('dayname')
            ->get();
        foreach ($stamps_data as $key => $stamp) {
            if (date('l', strtotime($stamp->dayname)) == 'Monday') {
                $daily_stamps_collected[0] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Tuesday') {
                $daily_stamps_collected[1] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Wednesday') {
                $daily_stamps_collected[2] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Thursday') {
                $daily_stamps_collected[3] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Friday') {
                $daily_stamps_collected[4] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Saturday') {
                $daily_stamps_collected[5] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Sunday') {
                $daily_stamps_collected[6] = (int) $stamp->count;
            }
        }
        
        $complete_loyality_card = DB::table('customer_loyalty_claims')->where("business_id", $business->id)->sum('claim');
        //dd($complete_loyality_card);
        //redeemed points every day
        $daily_redeemed_points = array(0, 0, 0, 0, 0, 0, 0);
        $redeem_points = DB::table("customer_loyalty_claims")
            ->join("business", "business.id", "customer_loyalty_claims.business_id")
            ->where("business.user_id", Auth::user()->id)
            ->where("customer_loyalty_claims.claim", 1)
            ->select(DB::raw("(SUM(customer_loyalty_claims.claim)) as count"), DB::raw("(customer_loyalty_claims.created_at) as dayname"))
            ->whereBetween('customer_loyalty_claims.created_at', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])
            ->whereYear('customer_loyalty_claims.created_at', date('Y'))
            ->groupBy('dayname')
            ->get();
        foreach ($redeem_points as $key => $stamp) {
            if (date('l', strtotime($stamp->dayname)) == 'Monday') {
                $daily_redeemed_points[0] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Tuesday') {
                $daily_redeemed_points[1] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Wednesday') {
                $daily_redeemed_points[2] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Thursday') {
                $daily_redeemed_points[3] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Friday') {
                $daily_redeemed_points[4] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Saturday') {
                $daily_redeemed_points[5] = (int) $stamp->count;
            }
            if (date('l', strtotime($stamp->dayname)) == 'Sunday') {
                $daily_redeemed_points[6] = (int) $stamp->count;
            }
        }

        //Completed Loyalty Cards
        $stamps_comp = $redeem_points->sum('count');

        $business_location = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business_details.*")->get();

        $business = Business::where("user_id", Auth::user()->id)->get();

        $business_locations = Business::join("business_details", "business_details.business_id", "business.id")
        ->where("user_id", Auth::user()->id)
        ->where("business_details.status",1)
        ->select("business_details.*")->get();
    $open_timings = array();
    foreach ($business_locations as $business_location) {
        if ($business_location) {
            $open_timing = $this->handle_days($business_location->open_days, $business_location->open_time, $business_location->close_time);
            $open_timings[] = @$open_timing['timings'];
        } else {
            $open_timings[] = array();
        }
    }

    $business2 = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business.*")->first();

        if ($business2) {
            $loyalties = Loyalty_Scheme::where("business_id", $business2->id)->get()->toArray();
        } else {
            $loyalties = array();
        }

        return view("business_dashboard.index")->with("data", array("daily_redeemed_points" => $daily_redeemed_points, "daily_stamps_collected" => $daily_stamps_collected, "customers" => $customers, "stamps" => $stamps, "comp" => $stamps_comp))->with("locations", $business_location)->with("business", $business)->with("locations", $business_locations)->with("times", @$open_timings)->with("business2", $business2)->with("loyalties", $loyalties)->with("complete_loyality_card", $complete_loyality_card);

    }

    public function locations(Request $request)
    {
        if (Auth::user()->delete == 1) {
            return redirect()->route("business.account");
        }
        $business_locations = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business_details.*")->get();
        $open_timings = array();
        foreach ($business_locations as $business_location) {
            if ($business_location) {
                $open_timing = $this->handle_days($business_location->open_days, $business_location->open_time, $business_location->close_time);
                $open_timings[] = @$open_timing['timings'];
            } else {
                $open_timings[] = array();
            }
        }

        return view("business_dashboard.location")->with("locations", $business_locations)->with("times", @$open_timings);

    }

    public function profile(Request $request)
    {
        // if account is cancelled redirect to account details
        if (Auth::user()->delete == 1) {
            return redirect()->route("business.account");
        }
        $business = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business.*")->first();

        if ($business) {
            $loyalties = Loyalty_Scheme::where("business_id", $business->id)->get()->toArray();

        } else {
            $loyalties = null;
        }
        return view("business_dashboard.profile")->with("business", $business)->with("loyalties", $loyalties);

    }

    public function account(Request $request)
    {
        $business = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business.*")->first();

        return view("business_dashboard.account-details")->with("business", $business);
    }

    public function billing(Request $request)
    {
        // if account is cancelled redirect to account details
        if (Auth::user()->delete == 1) {
            return redirect()->route("business.account");
        }
        $business = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business.*")->first();

        $business_location = Business::join("business_details", "business_details.business_id", "business.id")
            ->where("user_id", Auth::user()->id)
            ->select("business_details.*")->get();

        return view("business_dashboard.billing")->with("business", $business)->with("locations", $business_location);
    }

    public function plan(Request $request)
    {
        // if account is cancelled redirect to account details
        if (Auth::user()->delete == 1) {
            return redirect()->route("business.account");
        }
        $plans = Plans::all();
        return view("business_dashboard.your-plan")->with(array("plans" => $plans));
    }

    public function handle_days($days, $open, $close)
    {

        $days = json_decode($days);
        $open = json_decode($open);
        $close = json_decode($close);
        $current_open = null;
        $current_close = null;
        $timings = [];
        $current_day = date("l");
        // dd($current_day);
        // $current_day=strtolower($current_day);

        foreach ($days as $index => $value) {
            $days = [];

            $days['day'] = ucfirst($value);

            if ($open[$index] != null && $close[$index] != null) {
                if ($current_day == $value) {
                    $current_open = $open[$index];
                    $current_close = $close[$index];

                }
                $days['status'] = "open";
                $days['open_time'] = $open[$index];
                $days['close_time'] = $close[$index];

            } else {
                $days['status'] = "close";
                $days['open_time'] = null;
                $days['close_time'] = null;
            }

            $timings[] = $days;
        }

        $obj['timings'] = $timings;
        $obj['current_open_time'] = $current_open;
        $obj['current_close_time'] = $current_close;

        return $obj;

    }

    public function update_data(Request $request)
    {

        $input = $request->input();

        // time
        if (isset($input['field']) && $input['field'] == "time_table") {

            $data = $this->getdayslocation($input);
            $days = $data['days'];
            $close = $data['close_time'];
            $open = $data['open_time'];
            // $values['open_time']=json_encode($open);
            // $values['close_time']=json_encode($close);
            // $values['open_days']=json_encode($days);

            unset($input['table']);
            unset($input['field']);
            $id = $input['id'];
            unset($input['id']);
            BusinessDetails::where("id", $id)
                ->update([
                    "open_time" => json_encode($open), "close_time" => json_encode($close), "open_days" => json_encode($days),
                ]);

            return $data;

        }

        if (isset($input['field']) && $input['field'] == "stamps_per_day") {

            unset($input['table']);
            unset($input['field']);
            $id = $input['id'];
            unset($input['id']);

            $ids = Loyalty_Scheme::where("id", $id)->value('business_id');
            $input['Customer_Loyalty'] = Customer_Loyalty::select('id', 'collected_stamps', 'total_collected_stamps')
                ->where('business_id', $ids)
                ->where('claim', '!=', 0)
                ->get();

            foreach ($input['Customer_Loyalty'] as $item) {
                // 5 >= 6 logic
                if ($item->collected_stamps >= $input['stamps_per_day']) {
                    $input['Customer_Loyalty']->chunkById(100, function ($CustomerLoyalty) {
                        foreach ($CustomerLoyalty as $CustomerL) {
                            DB::table('customer_loyalty')
                                ->where('id', $CustomerL->id)
                                ->update(['collected_stamps' => $input['stamps_per_day']]);
                        }
                    });
                    $item->change = 'ok';
                } else {
                    $item->change = 'not';
                }

            }

            Loyalty_Scheme::where("id", $id)->update(['stamps_per_day' => $input['stamps_per_day']]);

        }
        if (isset($input['field']) && $input['field'] == "stamp_description") {

            unset($input['table']);
            unset($input['field']);
            $id = $input['id'];
            unset($input['id']);

            Loyalty_Scheme::where("id", $id)->update(['description' => $input['stamp_description']]);

        }
        if (isset($input['field']) && $input['field'] == "address") {
            unset($input['table']);
            unset($input['field']);
            $id = $input['id'];
            unset($input['id']);
            BusinessDetails::where("id", $id)
                ->update([
                    "address" => $input['address'], "lat" => $input['lat'], "lon" => $input['lon'],
                ]);

        }

        if (isset($input['field']) && $input['field'] == "business_address") {
            unset($input['table']);
            unset($input['field']);
            $id = $input['id'];
            unset($input['id']);
            Business::where("id", $id)
                ->update([
                    "business_address" => $input['address'], "lat" => $input['lat'], "lon" => $input['lon'],
                ]);

        }

        if (isset($input['field'])) {
            if ($input['field'] == "description"
                || $input['field'] == "facebook_link"
                || $input['field'] == "instagram_link") {
                //  dd($input);
                unset($input['table']);
                $field = $input['field'];
                unset($input['field']);
                $id = $input['id'];
                unset($input['id']);
                Business::where("id", $id)
                    ->update([
                        $field => $input[$field]
                    ]);
            }

        }

        return $input;

    }

    public function update_pwd(Request $request)
    {

        $old_pwd = $request->old_password;
        $new_pwd = $request->new_password;

        $hashedPassword = User::find(Auth::user()->id)->password;

        if (Hash::check($old_pwd, $hashedPassword)) {
            $new_pwd = Hash::make($new_pwd);
            User::where("id", Auth::user()->id)->update(['password' => $new_pwd]);
            return response()->json(['same' => "yes"], 200);
        } else {
            return response()->json(['same' => 'no'], 404);
        }

    }

    public function update_profile(Request $request)
    {

        $input = $request->input();

        User::where("id", Auth::user()->id)->update(['name' => $input['name']]);

        $business = Business::find($input['id']);
        if (isset($input['business_email'])) {
            $business->business_email = $input['business_email'];
        }
        if (isset($input['business_number'])) {
            $business->business_number = $input['business_number'];
        }
        $business->save();
        return $input;

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

    public function update_plan(Request $request)
    {

        $val = $request->plan;

        business::where("user_id", Auth::user()->id)->update(['plan' => $val]);
        return json_encode("ok", 200);

    }

    public function add_location(Request $request)
    {

        $input = $request->input();
        $values['business_id'] = $input['business_id'];
        $values['address'] = $input['address'];
        $values['lat'] = $input['lat'];
        $values['lon'] = $input['lon'];
        $data = $this->getdayslocation($input);

        $values['open_days'] = json_encode($data['days']);
        $values['close_time'] = json_encode($data['close_time']);
        $values['open_time'] = json_encode($data['open_time']);

        $count = DB::table("business")->join("business_details", "business.id", "business_details.business_id")
            ->where("business.user_id", auth()->user()->id)->count();
        if ($count < 3) {
            BusinessDetails::insert($values);
        }

        return redirect()->back()->with('success', 'Location added successfully');

    }

    public function uploadImages(Request $request)
    {

        $userBussiness = Business::where('user_id', Auth()->user()->id)->first();

        if ($request->has('cardInput')) {

            $userBussinessLoyalty = Loyalty_Scheme::find($request->get('loyality_id'));
            $imageName = time() . '.' . $request->cardInput->extension();
            $userBussinessLoyalty->img = 'images/profile/' . $imageName;
            $request->cardInput->move(public_path('images/profile'), $imageName);
            $userBussinessLoyalty->save();
        } else {
            if ($request->has('coverInput')) {
                $imageName = time() . '.' . $request->coverInput->extension();
                $userBussiness->cover_img = 'images/profile/' . $imageName;
                $request->coverInput->move(public_path('images/profile'), $imageName);
            }
            if ($request->has('profilePicInput')) {
                $imageName = time() . '.' . $request->profilePicInput->extension();
                $userBussiness->image = 'images/profile/' . $imageName;
                $request->profilePicInput->move(public_path('images/profile'), $imageName);
            }
            $userBussiness->save();
        }

        if ($request->get('useLogo')) {
            $userBussinessLoyalty = Loyalty_Scheme::find($request->get('loyality_id'));
            $userBussinessLoyalty->img = $request->get('useLogo');
            $userBussinessLoyalty->save();
        }

        // if(!File::exists($path)) {
        //     Storage::putFile('avatars', $request->file('avatar'));
        // }
        return 'updated';
    }
    public function addNewScheme(Request $request)
    {
        $input = $request->input();
        $userBussiness = Business::where('user_id', Auth()->user()->id)->first();

        if (!empty($request->get('scheme-logo')) or !empty($_FILES['newSchemeImg']['name'])) {

            if (empty($request->get('scheme-logo'))) {
                if ($request->has('newSchemeImg')) {
                    $imageName = time() . '.' . $request->newSchemeImg->extension();
                    $img = 'images/profile/' . $imageName;
                    $request->newSchemeImg->move(public_path('images/profile'), $imageName);
                }
            } else { $img = $request->get('scheme-logo');}
            $loyalty_scheme = new Loyalty_Scheme();
            $loyalty_scheme->business_id = $userBussiness->id;
            $loyalty_scheme->name = 'random';
            $loyalty_scheme->description = $request->get('description');
            $loyalty_scheme->img = @$img;
            $loyalty_scheme->is_logo = !empty($request->get('scheme-logo')) ? 1 : 0;
            $loyalty_scheme->offer_expiry = date('Y-m-d', strtotime('+3000000 days', strtotime(date('Y-m-d'))));
            $loyalty_scheme->number_stamps = $request->get('number_stamps');
            $loyalty_scheme->stamps_per_day = 10;
            $loyalty_scheme->save();
            return redirect("business/profile")->withSuccess("Loyality card added Sucessfully!");
        } else {
            return redirect("business/profile")->withError("Loyality image is required");
        }
    }
    // Delete Loyality card
    public function delete_loyality(Request $request)
    {
        $id = $request->get('id');
        $del = Loyalty_Scheme::where('id', $id)->delete();
        return json_encode(["msg" => "deleted"]);
    }
    // Delete Location
    public function delete_location(Request $request)
    {
        $id = decrypt($request->get('id'));
        $del = BusinessDetails::where('id', $id)->delete();
        return json_encode(["msg" => "deleted"]);
    }
    // Delete Location
    public function remove_image($id)
    {
        $id = decrypt($id);
        $del = Loyalty_Scheme::where('id', $id)->update(['img' => null]);
        return redirect("business/profile")->withSuccess("Loyality card image deleted Sucessfully!");
    }
    // cancel business account
    public function cancel_account()
    {
        $user_id = Auth::user()->id;
        $del = User::where('id', $user_id)->update(['delete' => 1]);
        return redirect("business/account")->withSuccess("Account Deactivated Sucessfully!");
    }
    // for reactivating account
    public function reactivate_account()
    {
        $user_id = Auth::user()->id;
        $del = User::where('id', $user_id)->update(['delete' => 0]);
        return redirect("business/account")->withSuccess("Account Deactivated Sucessfully!");
    }
}
