<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Customer as CustomerResource;
use App\Models\Business;
use App\Models\BusinessDetails;
use App\Models\Customer_Purchase_Scheme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends BaseController
{
    public $user;
    public function __construct()
    {

        $this->user = Auth::guard('api')->user();
    }

    public function profile(Request $request)
    {

        $details = $this->user;

        return $this->sendResponse(new CustomerResource($details), 'Customer Fetch successfully.');
    }

    public function update(Request $request)
    {

        $input = $request->input();

        $user = User::find($this->user->id);

        if ($request->hasFile('img')) {

            $image = $request->file('img');

            $name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/images/');

            $image->move($destinationPath, $name);

            $user->img = "images/" . $name;
        }

        if (isset($input['name'])) {

            $user->name = $request->name;
        }

        if (isset($input['password'])) {

            $user->password = bcrypt($request->password);
        }

        if (isset($input['dob'])) {

            $user->dob = $request->dob;
        }

        if (isset($input['gender'])) {

            $user->gender = $request->gender;
        }

        $user->save();

        $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $user->id], ['isOneRewardCollected', 'true']])->first();

        if ($scheme_purchase) {
            $user->isOneRewardCollected = true;
        } else {
            $user->isOneRewardCollected = false;
        }

        return $this->sendResponse(new CustomerResource($user), 'Profile Updated successfully.');
    }

    public function loyalty_offers(Request $request)
    {

        $lat = $request->lat;

        $lon = $request->lon;

        $distance = $request->distance;

        $limit = 10;

        $query = $request->query();

        $offset = 0;

        if (isset($query['offset'])) {

            $offset = $query['offset'];
        }

        if (isset($query['limit'])) {

            $limit = $query['limit'];
        }

        $currentDate = date('Y-m-d');

        $currentDate = date('Y-m-d', strtotime($currentDate));

        $count = DB::table("business")->join("business_details", "business_details.business_id", "business.id")->count();

        $offers = Business::select(
            "business.id as business_id",
            "business_details.id as lid",
            "business.business_name as business_name",

            "business.description as business_description",
            "business.facebook_link",
            "business.instagram_link",

            "business.twitter_link",
            "business.image as business_logo",
            "business.cover_img as business_cover_img",

            DB::raw("3959  * acos(cos(radians(" . $lat . "))

                    * cos(radians(business_details.lat))

                    * cos(radians(business_details.lon) - radians(" . $lon . "))

                    + sin(radians(" . $lat . "))

                    * sin(radians(business_details.lat))) AS distance")

        )

            ->join("business_details", "business_details.business_id", "business.id")
            ->join("users", "users.id", "business.user_id")
            ->where('users.delete', 0)
            ->where('users.account_status', 'active')
            ->whereIn('business_details.id',function($q){
                $q->select('business_location_id')
                ->from('nfc_tags')
                ->whereColumn('business.id','nfc_tags.business_id')
                ->whereColumn('business_details.id','nfc_tags.business_location_id');
            })
        //  ->having('distance', '<', 500000)

            ->limit($limit)

            ->offset($offset)

            ->orderBy('distance', 'ASC')

            ->get();

        $details = [];

        foreach ($offers as $offer) {

            $offer->distance = round($offer->distance, 4);

            if ($offer->business_logo) {

                $offer->business_logo = env("APP_URL") . $offer->business_logo;
            } else {

                $offer->business_logo = env("APP_URL") . "images/61c1e4124e0be.jpeg";
            }

            if ($offer->business_cover_img) {

                $offer->business_cover_img = env("APP_URL") . $offer->business_cover_img;
            } else {

                $offer->business_cover_img = env("APP_URL") . "images/Bitmap.png";
            }

            $locations = BusinessDetails::where("business_id", $offer->business_id)

                ->select("*", DB::raw("3959  * acos(cos(radians(" . $lat . "))

                    * cos(radians(business_details.lat))

                    * cos(radians(business_details.lon) - radians(" . $lon . "))

                    + sin(radians(" . $lat . "))

                    * sin(radians(business_details.lat))) AS distance"))

                ->get();

            foreach ($locations as $location) {

                $open_timing = $this->handle_days(
                    $location->open_days,
                    $location->open_time,

                    $location->close_time
                );

                $new_address = explode(",", $location->address);

                if (count($new_address) >= 2) {

                    $location->address = $new_address[0] . ", " . $new_address[1];
                }

                // $location->distance=$this->distance($lat,$lon,$location->lat,$location->lon,"N");

                $location->distance = round($location->distance, 4);

                $location->timing = $open_timing['timings'];

                $location->location_open_time = $open_timing['current_open_time'];

                $location->location_close_time = $open_timing['current_close_time'];

                unset($location->open_days);

                unset($location->open_time);

                unset($location->close_time);

                $approved_scheme = DB::select("SELECT *

                        FROM   loyalty_scheme

                        WHERE  id IN (SELECT loyalty_id FROM nfc_tags" . " where business_location_id=" . $location->id . ")

                        and business_id=" . $location->business_id);

                foreach ($approved_scheme as $ap) {

                    if ($ap->img) {

                        $ap->scheme_background = env("APP_URL") . preg_replace("/\r|\n/", "", $ap->img);
                    } else {

                        $ap->scheme_background = env("APP_URL") . "images/Bitmap.png";
                    }

                    $scheme_purchase = Customer_Purchase_Scheme::where([['scheme_id', $ap->id], ['customer_id', $this->user->id]])->first();
                    if ($scheme_purchase) {
                        $ap->is_lock = false;
                    } else {
                        $ap->is_lock = true;
                    }
                    $customer = DB::table("customer_loyalty")

                        ->where("customer_id", $this->user->id)

                        ->where("business_id", $ap->business_id)

                        ->where("loyalty_id", $ap->id)
                        ->orderBy('updated_at', 'DESC')
                        ->first();

                    if ($customer) {

                        $date_now = Carbon::parse($customer->updated_at)->addDay(30);
                        $days = now()->diff($date_now)->days;
                        $new_days = (now() == $date_now or now() > $date_now) ? 0 : $days;

                        $date1 = date_create($customer->updated_at);
                        $currentDate = date_create(now());

                        $interval = date_diff($date1, $currentDate);

                        $days = $interval->format("%a");

                        if ($new_days <= 30)
                        {
                             if ((30 - $days) == 0)
                             {
                                        $ap->claim_reward = false;

                            $ap->collected_stamps = 0;
    
                            $ap->customer_loyalty_id = null;
    
                            $ap->offer_expiry = null;
    
                            $ap->expiry_days = null;
                                 
                             }else{
                                  if ($customer->collected_stamps == $ap->number_stamps && $customer->claim == 0) {

                                $ap->claim_reward = true;
                            } else {
    
                                $ap->claim_reward = false;
                            }
    
                            $ap->collected_stamps = $customer->collected_stamps;
    
                            $ap->customer_loyalty_id = $customer->id;
    
                            $diff = now()->diffInDays(Carbon::parse(
    
                                date('Y-m-d', strtotime($customer->updated_at))
    
                            ));
    
                            $detail = 30 - ($diff + 1);
    
                          
                            //
    
                            $ap->ads_expiry = ($days - 30) <= 30 ? 'Expires in ' . ($days - 30) . ' Days' : 'Expired';
    
                            $ap->offer_expiry = Carbon::parse(date('Y-m-d', strtotime($customer->updated_at)))->addDays(30)->format('Y-m-d');
    
                            //  $ap->expiry_days =  $new_days+1;

                            if ($days <= 30) {
                                $ap->expiry_days = 30 - $days;
                            } else {
                                $ap->expiry_days = 0;
                            }
                             }
                           
                        }else{
                            $ap->claim_reward = false;

                            $ap->collected_stamps = 0;
    
                            $ap->customer_loyalty_id = null;
    
                            $ap->offer_expiry = null;
    
                            $ap->expiry_days = null;
                        }

                    } else {

                        $ap->claim_reward = false;

                        $ap->collected_stamps = 0;

                        $ap->customer_loyalty_id = null;

                        $ap->offer_expiry = null;

                        $ap->expiry_days = null;
                    }

                    unset($ap->img);
                }

                $location->approved_scheme = $approved_scheme;

                $pending_scheme = DB::select("SELECT *

                        FROM   loyalty_scheme

                        WHERE  id NOT IN (SELECT loyalty_id FROM nfc_tags" . " where business_location_id=" . $location->id . ")

                        and business_id=" . $location->business_id);

                foreach ($pending_scheme as $pe) {

                    if ($pe->img) {

                        $pe->scheme_background = env("APP_URL") . $pe->img;
                    } else {

                        $pe->scheme_background = env("APP_URL") . "images/Bitmap.png";
                    }

                    unset($pe->img);
                }

                $location->pending_scheme = $pending_scheme;
            }

            $offer->business_locations = $locations;
        }
        $scheme_purchase = Customer_Purchase_Scheme::where([['customer_id', $this->user->id], ['isOneRewardCollected', 'true']])->first();

        if ($scheme_purchase) {
            $data['isOneRewardCollected'] = true;
        } else {
            $data['isOneRewardCollected'] = false;
        }

        $data['offers'] = $offers;

        $data['total_count'] = $count;

        return $this->sendResponse($data, 'Offers retrieved successfully  with lat:' . $lat . " ,lon" . $lon);
    }

    public function loyalty_offers_search(Request $request)
    {

        $lat = $request->lat;

        $lon = $request->lon;

        $distance = $request->distance;

        // $limit=10;

        // $query=$request->query();

        // $offset=0;

        $searchTerm = $request->search;

        // if(isset($query['offset'])){

        //     $offset=$query['offset'];

        // }

        //  if(isset($query['limit'])){

        //     $limit=$query['limit'];

        // }

        $currentDate = date('Y-m-d');

        $currentDate = date('Y-m-d', strtotime($currentDate));

        $count = DB::table("business")->join("business_details", "business_details.business_id", "business.id")
            ->join("nfc_tags", "nfc_tags.business_location_id", "business_details.id")
            ->where('business_name', 'LIKE', "%{$searchTerm}%")
            ->where('business_details.status',1)

            ->count();

        $offers = Business::select(
            "business.id as business_id",
            "business_details.id as lid",
            "business.business_name as business_name",

            "business.description as business_description",
            "business.facebook_link",
            "business.instagram_link",

            "business.twitter_link",
            "business.image as business_logo",
            "business.cover_img as business_cover_img",

            DB::raw("3959  * acos(cos(radians(" . $lat . "))

     * cos(radians(business_details.lat))

     * cos(radians(business_details.lon) - radians(" . $lon . "))

     + sin(radians(" . $lat . "))

     * sin(radians(business_details.lat))) AS distance")

        )

            ->join("business_details", "business_details.business_id", "business.id")
            ->join("users", "users.id", "business.user_id")
            ->join("nfc_tags", "nfc_tags.business_location_id", "business_details.id")
            ->where('business_name', 'LIKE', "%{$searchTerm}%")
            ->where('users.delete', 0)
            ->where('users.account_status', 'active')
            ->where('business_details.status',1)
            ->whereIn('business_details.id',function($q){
                $q->select('business_location_id')
                ->from('nfc_tags')
                ->whereColumn('business.id','nfc_tags.business_id')
                ->whereColumn('business_details.id','nfc_tags.business_location_id');
            })

        // ->limit($limit)

        // ->offset($offset)

            ->orderBy('distance')

            ->get();

        $details = [];

        foreach ($offers as $offer) {

            $offer->distance = round($offer->distance, 4);

            if ($offer->business_logo) {

                $offer->business_logo = env("APP_URL") . $offer->business_logo;
            } else {

                $offer->business_logo = env("APP_URL") . "images/61c1e4124e0be.jpeg";
            }

            if ($offer->business_cover_img) {

                $offer->business_cover_img = env("APP_URL") . $offer->business_cover_img;
            } else {

                $offer->business_cover_img = env("APP_URL") . "images/Bitmap.png";
            }

            $locations = BusinessDetails::where("business_id", $offer->business_id)

                ->select("*", DB::raw("3959  * acos(cos(radians(" . $lat . "))

             * cos(radians(business_details.lat))

             * cos(radians(business_details.lon) - radians(" . $lon . "))

             + sin(radians(" . $lat . "))

             * sin(radians(business_details.lat))) AS distance"))

                ->get();

            foreach ($locations as $location) {

                $open_timing = $this->handle_days(
                    $location->open_days,
                    $location->open_time,

                    $location->close_time
                );

                $new_address = explode(",", $location->address);

                if (count($new_address) >= 2) {

                    $location->address = $new_address[0] . ", " . $new_address[1];
                }

                // $location->distance=$this->distance($lat,$lon,$location->lat,$location->lon,"N");

                $location->distance = round($location->distance, 4);

                $location->timing = $open_timing['timings'];

                $location->location_open_time = $open_timing['current_open_time'];

                $location->location_close_time = $open_timing['current_close_time'];

                unset($location->open_days);

                unset($location->open_time);

                unset($location->close_time);

                $approved_scheme = DB::select("SELECT *

                        FROM   loyalty_scheme

                        WHERE  id IN (SELECT loyalty_id FROM nfc_tags" . " where business_location_id=" . $location->id . ")

                        and business_id=" . $location->business_id);

                foreach ($approved_scheme as $ap) {

                    if ($ap->img) {

                        $ap->scheme_background = env("APP_URL") . preg_replace("/\r|\n/", "", $ap->img);
                    } else {

                        $ap->scheme_background = env("APP_URL") . "images/Bitmap.png";
                    }

                    $customer = DB::table("customer_loyalty")

                        ->where("customer_id", $this->user->id)

                        ->where("business_id", $ap->business_id)

                        ->where("loyalty_id", $ap->id)

                        ->first();

                    if ($customer) {

                        if ($customer->collected_stamps == $ap->number_stamps && $customer->claim == 0) {

                            $ap->claim_reward = true;
                        } else {

                            $ap->claim_reward = false;
                        }

                        $ap->collected_stamps = $customer->collected_stamps;

                        $ap->customer_loyalty_id = $customer->id;

                        $diff = now()->diffInDays(Carbon::parse(

                            date('Y-m-d', strtotime($customer->updated_at))

                        ));

                        $detail = 30 - $diff;

                        $ap->offer_expiry =

                        Carbon::parse(date('Y-m-d', strtotime($customer->updated_at)))->addDays(7)->format('Y-m-d');

                        $ap->expiry_days = $detail;

                        $date_now = Carbon::parse($customer->updated_at)->addDay(7);
                        $days = now()->diff($date_now)->days;
                        $new_days = (now() == $date_now or now() > $date_now) ? 0 : $days;
                        $ap->ads_expiry = $new_days == 0 ? 'Expired' : 'Expires in ' . ($new_days + 1) . ' Days';
                    } else {

                        $ap->claim_reward = false;

                        $ap->collected_stamps = 0;

                        $ap->customer_loyalty_id = null;

                        $ap->offer_expiry = null;

                        $ap->expiry_days = null;
                    }

                    unset($ap->img);
                }

                $location->approved_scheme = $approved_scheme;

                $pending_scheme = DB::select("SELECT *

                            FROM   loyalty_scheme

                            WHERE  id NOT IN (SELECT loyalty_id FROM nfc_tags" . " where business_location_id=" . $location->id . ")

                            and business_id=" . $location->business_id);

                foreach ($pending_scheme as $pe) {

                    if ($pe->img) {

                        $pe->scheme_background = env("APP_URL") . $pe->img;
                    } else {

                        $pe->scheme_background = env("APP_URL") . "images/Bitmap.png";
                    }

                    unset($pe->img);
                }

                $location->pending_scheme = $pending_scheme;
            }

            $offer->business_locations = $locations;
        }

        $data['offers'] = $offers;

        $data['total_count'] = $count;

        return $this->sendResponse($data, 'Offers retrieved successfully  with lat:' . $lat . " ,lon" . $lon);
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

                // if ($current_day == $value) {

                //     if ((date("g:ia", strtotime($open[$index])) >= date('g:ia')) && (date("g:ia", strtotime($close[$index])) <= date('g:ia'))) {
                //         $current_open = $open[$index];

                //         $current_close = $close[$index];
                //         $days['status'] = "open";
                //     }
                // }

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

    public function loyalty_offers_single(Request $request, $id)
    {

        $offers = DB::table("loyalty_scheme")

            ->join("business_details", "business_details.business_id", "loyalty_scheme.business_id")

            ->join("business", "business.id", "loyalty_scheme.business_id")

        // ->join("nfc_tags","nfc_tags.business_location_id","business_details.id")

        // ->where("business_details.id",$request->business_location_id)

            ->where("loyalty_scheme.id", $id)

        // ->where("loyalty_scheme.status","approved")

            ->select(
                "loyalty_scheme.*",
                "business.description as business_description",

                "business_details.open_time",
                "business_details.close_time",
                "business_details.open_days",

                "business.facebook_link",
                "business.instagram_link",
                "business.twitter_link",

                "business_details.lat",
                "business_details.lon",
                "business.cover_img as business_background",
                "business.image as business_logo"
            )

            ->get();

        // dd($offers);

        foreach ($offers as $offer) {

            if ($offer->img) {

                $offer->img = env("APP_URL") . $offer->img;
            } else {

                $offer->img = env("APP_URL") . "images/61c1e4124e0be.jpeg";
            }

            $offer->scheme_cover_img = $offer->img;

            $offer->scheme_name = $offer->name;

            $open_timing = $this->handle_days($offer->open_days, $offer->open_time, $offer->close_time);

            $offer->timings = $open_timing;

            unset($offer->open_days);

            unset($offer->name);

            unset($offer->img);

            unset($offer->open_time);

            unset($offer->close_time);

            if ($offer->business_background) {

                $offer->business_background = env("APP_URL") . $offer->business_background;
            } else {

                $offer->business_background = env("APP_URL") . "images/Bitmap.png";
            }
        }

        return $this->sendResponse($offers, 'Offer retrieved successfully.');
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;

        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

        $dist = acos($dist);

        $dist = rad2deg($dist);

        $miles = $dist * 60 * 1.1515;

        $unit = strtoupper($unit);

        if ($unit == "K") {

            return ($miles * 1.609344);
        } else if ($unit == "N") {

            return ($miles * 0.8684);
        } else {

            return $miles;
        }
    }

    public function app_purchase_plan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_purchase_plan' => "required",
            'app_purchase_plan_expiry' => 'required|',
        ]);

        //
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::find($this->user->id);
        if (!empty($user->app_purchase_plan_expiry) && strtotime(date('Y-m-d')) < strtotime($user->app_purchase_plan_expiry) && $user->plan_status == 1) {
            return $this->sendError("Plan already purchased", $user);
        }

        $user->app_purchase_plan = $request->get('app_purchase_plan');
        $user->app_purchase_plan_expiry = $request->get('app_purchase_plan_expiry');
        $user->plan_status = 1;
        $user->save();
        return $this->sendResponse($user, 'Plan purchased successfully');
    }

    public function app_purchase_plan_cancel(Request $request)
    {

        $user = User::find($this->user->id);

        $user->plan_status = 0;
        $user->save();
        return $this->sendResponse($user, 'Plan Cancel Successfully');
    }

    public function customer_scheme_purchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'scheme_id' => "required",
            'customer_id' => 'required|',
            'business_id' => 'required|',
        ]);

        //
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $already_purchase = Customer_Purchase_Scheme::where([['scheme_id', $request->get('scheme_id')], ['customer_id', $this->user->id]])->first();
        if ($already_purchase) {
            return $this->sendError('Scheme already purchased.', $already_purchase);
        }
        $customer_scheme_purchase = Customer_Purchase_Scheme::create($request->all());

        return $this->sendResponse($customer_scheme_purchase, 'Scheme purchased successfully');
    }
}
