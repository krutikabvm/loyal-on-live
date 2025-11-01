<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Busniness as BusninessResource;
use App\Models\Business;
use App\Models\BusinessDetails;
use App\Models\Loyalty_Scheme;
use App\Models\NfcTag;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\LimitedPerks;
use App\Models\LimitedPerksUsers;
use App\Models\SavedLimitedPerks;

use Validator;
use Carbon\Carbon;

class BusinessController extends BaseController
{
    //

    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('api')->user();

    }

    public function index()
    {

        $details = Business::where("verify", "!=", "delete")
            ->orderBy('id', 'DESC')
            ->get();
        $response = BusninessResource::collection($details);

        return $this->sendResponse($response, 'Businesses retrieved successfully.');

    }

    public function Business_detail($id)
    {

        $details = Business::where('id', $id)->first();
        if ($details) {
            return $this->sendResponse(new BusninessResource($details), 'Business details.');
        } else {

            return $this->sendResponse(["success" => false], 'Bussiness Not Found.');
        }

    }

    public function Business_delete($id)
    {
        db::table("business")->where("id", $id)->update([
            'verify' => "delete"]);

        return $this->sendResponse([], 'Businesses deleted successfully.');

    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'business_name' => 'required|unique:business,business_name',
            'description' => "required",
            'facebook_link' => "required_without_all:twitter_link,instagram_link",
            'twitter_link' => "required_without_all:facebook_link,instagram_link",
            'instagram_link' => "required_without_all:twitter_link,facebook_link",
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $business = Business::find($id);

        $business->business_name = $request->business_name;
        $business->description = $request->description;
        $business->facebook_link = $request->facebook_link;
        $business->twitter_link = $request->twitter_link;
        $business->instagram_link = $request->instagram_link;
        $business->save();

        return $this->sendResponse(new BusninessResource($business), 'Business details.');

    }

    public function get_loyalty_schemes_approved(Request $request)
    {

        $approved_schemes = DB::Select('select business.*,count(*) as approved_schemes from business INNER JOIN loyalty_scheme ON loyalty_scheme.business_id=business.id where loyalty_scheme.status="approved" Group BY business.id');

        foreach ($approved_schemes as $ps) {

            if ($ps->image) {
                $ps->image = env("APP_URL") . $ps->image;
            } else {
                $ps->image = env("APP_URL") . "images/61c1e4124e0be.png";

            }

            if ($ps->cover_img) {
                $ps->cover_img = env("APP_URL") . $ps->cover_img;
            } else {
                $ps->cover_img = env("APP_URL") . "images/Bitmap.png";
            }

        }

        $pending_schemes_count = DB::table("loyalty_scheme")->where("status", "pending")
            ->count();

        $data["map"] = $approved_schemes;
        $data['total_pending'] = $pending_schemes_count;

        return $this->sendResponse($data, 'Approved Schemes.');

    }

    public function get_loyalty_schemes_pending(Request $request)
    {

        // $pending_schemes = DB::Select('select business.*
        //               from business INNER JOIN users ON
        //               users.id=business.user_id INNER JOIN loyalty_scheme ON
        //               loyalty_scheme.business_id=business.id
        //             where users.account_status ="active"
        //               Group BY business.id');

        $pending_schemes = DB::Select('select (SELECT COUNT(*) from loyalty_scheme where loyalty_scheme.status = "pending" AND loyalty_scheme.business_id = business.id ) as pending_schemes, business.* from business INNER JOIN users ON
                      users.id=business.user_id INNER JOIN loyalty_scheme ON
                      loyalty_scheme.business_id=business.id
                    where  loyalty_scheme.status = "pending"
                      Group BY business.id');

        // old
        //  $pending_schemes=DB::Select('select business.*
        //   from business INNER JOIN loyalty_scheme ON
        //   loyalty_scheme.business_id=business.id
        // where loyalty_scheme.status ="pending"
        //   Group BY business.id');

        foreach ($pending_schemes as $ps) {

            if ($ps->image) {
                $ps->image = env("APP_URL") . $ps->image;
            } else {
                $ps->image = env("APP_URL") . "images/61c1e4124e0be.png";

            }

            if ($ps->cover_img) {
                $ps->cover_img = env("APP_URL") . $ps->cover_img;
            } else {
                $ps->cover_img = env("APP_URL") . "images/Bitmap.png";
            }

            // $scheme = DB::select("SELECT count(*) as pending_scheme
            //             FROM   loyalty_scheme  where status='pending' and business_id=" . $ps->id);

            // $ps->pending_schemes = $scheme[0]->pending_scheme;

        }

        return $this->sendResponse($pending_schemes, 'Pending Schemes.');

    }

    public function single_loyalty_schemes_approved($id)
    {
        $business = business::find($id);

        if ($business->image) {
            $business->image = env("APP_URL") . $business->image;
        } else {
            $business->image = env("APP_URL") . "images/61c1e4124e0be.png";

        }

        if ($business->cover_img) {
            $business->cover_img = env("APP_URL") . $business->cover_img;
        } else {
            $business->cover_img = env("APP_URL") . "images/Bitmap.png";
        }

        $business['approved_schemes'] = Loyalty_Scheme::where("business_id", $id)->where("status", "approved")->get();

        foreach ($business['approved_schemes'] as $ps) {

            if ($ps->img) {
                $ps->img = env("APP_URL") . $ps->img;
            } else {
                $ps->img = env("APP_URL") . "images/61c1e4124e0be.png";

            }

        }

        return $this->sendResponse($business, 'Approved Schemes.');

    }
    public function single_loyalty_schemes_pending($id)
    {

        $business = business::find($id);

        if ($business->image) {
            $business->image = env("APP_URL") . $business->image;
        } else {
            $business->image = env("APP_URL") . "images/61c1e4124e0be.png";

        }

        if ($business->cover_img) {
            $business->cover_img = env("APP_URL") . $business->cover_img;
        } else {
            $business->cover_img = env("APP_URL") . "images/Bitmap.png";
        }

        $business['pending_schemes'] = Loyalty_Scheme::where("business_id", $id)
            ->where("status", "pending")->get();

        foreach ($business['pending_schemes'] as $scheme) {

            if ($scheme['img'] != null) {
                $scheme['img'] = env("APP_URL") . $scheme['img'];
            } else {
                $scheme['img'] = env("APP_URL") . "images/61c1e4124e0be.png";
            }

        }

        return $this->sendResponse($business, 'Pending Schemes.');

    }

    public function offer_detail($offer)
    {
        $data = [];
        $details = Loyalty_Scheme::where("id", $offer)->first();
        if ($details) {
            $business = business::where("id", $details->business_id)->first();
            $business['offer_detail'] = $details;

            if (!empty($business->image)) {
                $business->image = env("APP_URL") . $business->image;
            } else {
                $business->image = env("APP_URL") . "images/61c1e4124e0be.png";

            }

            if ($business->offer_detail->img) {
                $business->offer_detail->img = env("APP_URL") . $business->offer_detail->img;
            }

            $business['approved_scheme_locations'] = BusinessDetails::whereIn('id', function ($query) use ($offer, $details) {
                return $query->select('business_location_id')
                    ->from('nfc_tags')
                    ->where('nfc_tags.loyalty_id', $offer);
            })
                ->where('business_id', $details->business_id)
                ->get();

            $business['pending_scheme_locations'] = BusinessDetails::whereNotIn('id', function ($query) use ($offer, $details) {
                return $query->select('business_location_id')
                    ->from('nfc_tags')
                    ->where('nfc_tags.loyalty_id', $offer);
            })
                ->where('business_id', $details->business_id)
                ->get();

            return $this->sendResponse($business, 'Scheme.');

        } else {
            return $this->sendError('No Loyalty Offer Found', $data);
        }

    }

    public function offer_status(Request $request, $offer)
    {

        $validator = Validator::make($request->all(), [
            'business_id' => 'required|exists:business,id',
            'business_location_id' => "required|exists:business_details,id",
            'nfc_detail' => "required",

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $check = BusinessDetails::where("business_id", $request->business_id)
            ->where("id", $request->business_location_id)
            ->first();

        if (empty($check)) {

            return $this->sendError('Validation Error.', [
                "Location" => array("This business has no location with given location id"),
            ]);
        }
        $offer_check = Loyalty_Scheme::find($offer);
        if (empty($offer_check)) {
            return $this->sendError('Validation Error.', [
                "Offer" => array("No such offer exist with given id"),
            ]);
        }
        if ($offer_check->business_id != $request->business_id) {
            return $this->sendError('Validation Error.', [
                "Offer" => array("Business has no offer with given offer_id"),
            ]);
        }

        $already_exist = NfcTag::where("business_id", $request->business_id)
            ->where("business_location_id", $request->business_location_id)
            ->where("loyalty_id", $offer)
            ->first();

        if ($already_exist) {

            return $this->sendError('Validation Error.', [
                "Offer" => array("NFC Already assign to current location"),
            ]);
        }

        $input = $request->input();
        $input['Loyalty_id'] = $offer;
        $tag_check = NfcTag::where("nfc_detail", $input['nfc_detail'])
            ->first();

        if (empty($tag_check)) {

            $business = business::where("id", $offer_check->business_id)->first();
            $business['offer_detail'] = $offer_check;
            if (empty($tag_check)) {

                $business['tag_id'] = NfcTag::create([
                    'business_id' => $request->business_id,
                    'business_location_id' => $request->business_location_id,
                    'nfc_detail' => $request->nfc_detail,
                    'Loyalty_id' => (Int) $offer,
                ])->id;

                $message = "NFC Assign successfully.";
            } else {

                $business['tag_id'] = $tag_check->id;
                $message = "NFC Already Exist.";
            }

            $locations_count = BusinessDetails::where("business_id", $request->business_id)
                ->count();
            $scheme_assign_count = NfcTag::where("loyalty_id", $offer)
                ->count();

            if ($locations_count == $scheme_assign_count) {
                $offer_check->status = "approved";
            }

            $offer_check->save();

            return $this->sendResponse($business, $message);

        } else {

            return $this->sendError('Error.', [
                "NFC Tag" => array("Tag Already Assign"),
            ]);
        }

    }

    public function Business_pending(Request $request)
    {
        $details = Business::where("verify", "pending")->get();

        return $this->sendResponse(BusninessResource::collection($details), 'Businesses retrieved successfully.');
    }

    public function Business_approved(Request $request, $id)
    {

        $details = Business::find($id);

        $details->verify = "success";
        $details->save();
        if ($details) {
            return $this->sendResponse(new BusninessResource($details), 'Business approved ');
        } else {

            return $this->sendResponse(["success" => false], 'Bussiness Not Found.');
        }

    }

    public function nfc_update(Request $request, $offer)
    {

        $validator = Validator::make($request->all(), [
            'nfc_detail' => "required",

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ["NFC tag Missing"]);
        }

        $tag_check = DB::table("nfc_tags")->where("nfc_detail", $request->nfc_detail)
            ->first();

        if ($tag_check) {
            return $this->sendError('Error.', [
                "NFC Tag" => array("Tag Already Assign"),
            ]);
        }

        DB::table("nfc_tags")
            ->where("loyalty_id", $offer)
            ->update(['nfc_detail' => $request->nfc_detail]);

        return $this->sendResponse(["success" => true], 'Nfc updated');

    }

    public function get_all_perks_data(Request $request){
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        $searchTerm = $request->query('search');

        $filter = $request->query('filter', 'All'); // Default to 'All'
        $userId = Auth::guard('api')->user()->id;

        $today = now()->toDateString();


        $limitedPerkUser = LimitedPerksUsers::
        where('user_id', Auth::guard('api')->user()->id)
        ->whereDate('created_at', Carbon::today()) // This passes today's date using Carbon
        ->whereHas('limitedPerk',function($q){
            $q->where('type','limited perk');
        })
        ->pluck('perk_id')
        ->toArray();
        // $savedlimitedPerk = SavedLimitedPerks::
        // where('user_id', Auth::guard('api')->user()->id)
        // ->pluck('perk_id')
        // ->toArray();
        $now = Carbon::now('Asia/Kolkata'); // Current time in Kolkata timezone
        $gracePeriodEnd = $now->subHours(2)->toDateTimeString(); // Add 2 hours to the current time

        $query = LimitedPerks::
        with(['business' => function ($query) use ($userLatitude, $userLongitude) {
            $query->select('business.*', DB::raw("
                (6371 * acos(
                    cos(radians($userLatitude)) *
                    cos(radians(lat)) *
                    cos(radians(lon) - radians($userLongitude)) +
                    sin(radians($userLatitude)) * sin(radians(lat))
                )) AS distance
            "));
        },
            'perkUsers' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Order perkUsers in descending order
            },
        ])
            ->whereNotIn('limited_perks.id',$limitedPerkUser)
            // ->whereNotIn('limited_perks.id',$savedlimitedPerk)
            ->join('business', 'limited_perks.business_id', '=', 'business.id')
            ->join("business_details", "business_details.business_id", "business.id")
            ->with('perkUsers')
            ->where('business_name', 'LIKE', "%{$searchTerm}%")
            ->select('limited_perks.*', DB::raw("
                (6371 * acos(
                    cos(radians($userLatitude)) *
                    cos(radians(business.lat)) *
                    cos(radians(business.lon) - radians($userLongitude)) +
                    sin(radians($userLatitude)) * sin(radians(business.lat))
                )) AS distance
            "))
            ->where(function ($q) use ($gracePeriodEnd) {
                $q->whereNull('limited_perks.expiration_date') // Include records with no expiration_date
                  ->orWhereRaw("STR_TO_DATE(limited_perks.expiration_date, '%d/%m/%Y %h:%i:%s %p') >= ?", [$gracePeriodEnd]);
            })

            ->distinct() // Ensure unique limited_perks.id
            ->withCount('perkUsers');

            // $todayDay = now()->format('D');
            // $query->where('week_days', 'LIKE', "%{$todayDay}%");

            if ($filter === 'Available Now') {
                $query->whereRaw("
                    limited_perks.limit > (
                        SELECT COUNT(*) FROM limited_perks_users
                        WHERE limited_perks_users.perk_id = limited_perks.id
                        AND limited_perks_users.user_id = ?
                        AND DATE(limited_perks_users.created_at) = ?
                    )
                ", [$userId, $today]);
            } elseif ($filter === 'Newest') {
                $query->orderBy('limited_perks.created_at', 'desc');
            } else {
                $query->orderBy('distance', 'asc'); // Default sorting
            }

            // Paginate results
            $limitedPerks = $query->paginate(10);


            foreach ($limitedPerks as $offer) {


                if($offer->type == 'limited perk'){
                    if (preg_match('/(\d+)\s+days?/', $offer->date_range, $matches)) {
                        // Handle days
                        $value = (int)$matches[1];
                        $date = date('d/m/Y 23:59', strtotime("+$value days"));
                    } elseif (preg_match('/(\d+)\s*day/', $offer->date_range, $matches)) {
                        // Handle a single day
                        $value = (int)$matches[1];
                        $date = date('d/m/Y 23:59', strtotime("+$value days"));
                    } elseif (preg_match('/(\d+)h\s*(\d+)m\s*(\d+)s/', $offer->date_range, $matches)) {
                        // Handle hours, minutes, and seconds
                        $hours = (int)$matches[1];
                        $minutes = (int)$matches[2];
                        $seconds = (int)$matches[3];
                        $date =  date('d/m/Y', strtotime("+0 days")) ." {$hours}:{$minutes}";
                    } else {
                        $date = "Invalid format";
                    }

                    $offer->expired_date = $date;

                }
                $offer->is_claimed = false; // Default value before the switch
                $offer->is_saved = false;

                $savedPerks = SavedLimitedPerks::where('user_id',Auth::guard('api')->user()->id)->where('perk_id',$offer->id)->first();
                if(!empty($savedPerks) || isset($savedPerks)){
                    $offer->is_saved = true;
                }
                if($offer->type == "ongoing perk"){
                    $userId = Auth::guard('api')->user()->id;

                    $today = now()->toDateString();


                    switch ($offer->uses_per_month) {

                        case 'Reusable daily' :
                        case 'Daily Uses':
                            // Check if the user has already claimed this perk today
                            $dailyClaim = LimitedPerksUsers::where('perk_id', $offer->id)
                                ->where('user_id', $userId)
                                ->whereDate('created_at', $today)
                                ->first();

                            if ($dailyClaim) {
                                $offer->is_claimed = true;
                            }
                            break;

                        case 'One time use':
                            // Check if the user has ever claimed this perk
                            $oneTimeClaim = LimitedPerksUsers::where('perk_id', $offer->id)
                                ->where('user_id', $userId)
                                ->first();

                            if ($oneTimeClaim) {
                                $offer->is_claimed = true;
                            }
                            break;

                        case 'No Limit':
                                $offer->is_claimed = false;
                            break;

                        default:
                            // Handle numeric limits (1–35 claims per month)
                            if (is_numeric($offer->uses_per_month)) {
                                $monthlyClaims = LimitedPerksUsers::where('perk_id', $offer->id)
                                    ->where('user_id', $userId)
                                    ->whereYear('created_at', now()->year)
                                    ->whereMonth('created_at', now()->month)
                                    ->count();

                                if ($monthlyClaims >= $offer->uses_per_month) {
                                    $offer->is_claimed = true;
                                }
                            }
                            break;
                    }
                }
                else{
                    if($offer->limit >=1){
                        $currentClaims = LimitedPerksUsers::where('perk_id', $offer->id)->count();
                        if ($currentClaims >= $offer->limit) {
                            $offer->is_claimed = true;
                        }


                        // Check if the user has already claimed the perk
                        $limitedPerkUser = LimitedPerksUsers::where('perk_id', $offer->id)
                            ->where('user_id', Auth::guard('api')->user()->id)
                            ->first();

                        if ($limitedPerkUser) {
                            $offer->is_claimed = true;
                        }
                    }

                }
                $offer->distance = round($offer->distance, 4);

                if ($offer->business->image) {

                    $offer->business_logo = env("APP_URL") . $offer->business->image;
                } else {

                    $offer->business_logo = env("APP_URL") . "images/61c1e4124e0be.jpeg";
                }

                if ($offer->business->cover_img) {

                    $offer->business_cover_img = env("APP_URL") . $offer->business->cover_img;
                } else {

                    $offer->business_cover_img = env("APP_URL") . "images/Bitmap.png";
                }

                $locations = BusinessDetails::where("business_id", $offer->business_id)

                    ->select("*", DB::raw("3959  * acos(cos(radians(" . $userLatitude . "))

                        * cos(radians(business_details.lat))

                        * cos(radians(business_details.lon) - radians(" . $userLongitude . "))

                        + sin(radians(" . $userLatitude . "))

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


                }

                $offer->business_locations = $locations;
            }

            $data['current_page'] = $limitedPerks->currentPage();
            $data['perkdata'] = $limitedPerks->items();
            $data['total'] = $limitedPerks->total();
            $data['per_page'] = $limitedPerks->perPage();
            $data['last_page'] = $limitedPerks->lastPage();
            // $data['limitedPerks'] = $limitedPerks;

        // $limitedPerks = LimitedPerks::with('business')->latest()->get();
        return $this->sendResponse($data,'');
    }

    public function get_perk_data($id){
        $limitedPerk = LimitedPerks:: with([
            'perkUsers' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Order perkUsers in descending order
            },
            'business'
        ])
        ->join('business', 'limited_perks.business_id', '=', 'business.id')
        ->join("business_details", "business_details.business_id", "business.id")
        ->with('perkUsers')
        ->withCount('perkUsers')
        ->find($id);

            $limitedPerk->distance = round($limitedPerk->distance, 4);

                if ($limitedPerk->business->image) {

                    $limitedPerk->business_logo = env("APP_URL") . $limitedPerk->business->image;
                } else {

                    $limitedPerk->business_logo = env("APP_URL") . "images/61c1e4124e0be.jpeg";
                }

                if ($limitedPerk->business->cover_img) {

                    $limitedPerk->business_cover_img = env("APP_URL") . $limitedPerk->business->cover_img;
                } else {

                    $limitedPerk->business_cover_img = env("APP_URL") . "images/Bitmap.png";
                }

                $limitedPerk->is_claimed = false; // Default value before the switch

                $limitedPerk->is_saved = false;

                $savedPerks = SavedLimitedPerks::where('user_id',Auth::guard('api')->user()->id)->where('perk_id',$limitedPerk->id)->first();
                if(!empty($savedPerks) || isset($savedPerks)){
                    $limitedPerk->is_saved = true;
                }

                if($limitedPerk->type == "ongoing perk"){
                    $userId = Auth::guard('api')->user()->id;

                    $today = now()->toDateString();


                    switch ($limitedPerk->uses_per_month) {

                        case 'Reusable daily' :
                        case 'Daily Uses':
                            // Check if the user has already claimed this perk today
                            $dailyClaim = LimitedPerksUsers::where('perk_id', $limitedPerk->id)
                                ->where('user_id', $userId)
                                ->whereDate('created_at', $today)
                                ->first();

                            if ($dailyClaim) {
                                $limitedPerk->is_claimed = true;
                            }
                            break;

                        case 'One time use':
                            // Check if the user has ever claimed this perk
                            $oneTimeClaim = LimitedPerksUsers::where('perk_id', $limitedPerk->id)
                                ->where('user_id', $userId)
                                ->whereYear('created_at', now()->year)
                                ->whereMonth('created_at', now()->month)
                                ->first();

                            if ($oneTimeClaim) {
                                $limitedPerk->is_claimed = true;
                            }
                            break;

                        case 'No Limit':
                                $limitedPerk->is_claimed = false;
                            break;

                        default:
                            // Handle numeric limits (1–35 claims per month)
                            if (is_numeric($limitedPerk->uses_per_month)) {
                                $dailyClaim = LimitedPerksUsers::where('perk_id', $limitedPerk->id)
                                ->where('user_id', $userId)
                                ->whereDate('created_at', $today)
                                ->first();

                                if ($dailyClaim) {
                                    $limitedPerk->is_claimed = true;
                                }
                                $monthlyClaims = LimitedPerksUsers::where('perk_id', $limitedPerk->id)
                                    ->where('user_id', $userId)
                                    ->whereYear('created_at', now()->year)
                                    ->whereMonth('created_at', now()->month)
                                    ->count();

                                if ($dailyClaim && $monthlyClaims <= $limitedPerk->uses_per_month) {
                                    $limitedPerk->is_claimed = true;
                                }
                            }
                            break;
                    }
                }
                else{
                    if($limitedPerk->limit >=1){
                        $currentClaims = LimitedPerksUsers::where('perk_id', $limitedPerk->id)->count();
                        if ($currentClaims >= $limitedPerk->limit) {
                            $limitedPerk->is_claimed = true;
                        }


                        // Check if the user has already claimed the perk
                        $limitedPerkUser = LimitedPerksUsers::where('perk_id', $limitedPerk->id)
                            ->where('user_id', Auth::guard('api')->user()->id)
                            ->first();

                        if ($limitedPerkUser) {
                            $limitedPerk->is_claimed = true;
                        }
                    }

                }

                $locations = BusinessDetails::where("business_id", $limitedPerk->business_id)

                    ->select("*")

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


                }

                $limitedPerk->business_locations = $locations;
        return $this->sendResponse($limitedPerk,'');
    }

    public function create_limited_perk(Request $request){

        // dd($request);
        $validator = Validator::make($request->all(), [
            'business_id' => 'required',
            'description' => 'required|string|max:255',
            'limit' => 'required|integer|min:1',
            'setTime' => 'required|string',
            'week_days' => 'nullable|array',  // week_days should be an array
            'week_days.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'date_range' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $existingOngoingPerks = LimitedPerks::where('business_id', $request->business_id)
       ->where('type', 'limited perk')
        ->where('status','!=','ended')
       ->count();

        if ($existingOngoingPerks >= 2) {
            return $this->error('error', 'A business can have a maximum of 2 limited perks.');
        }
        return LimitedPerks::create([
            'business_id' => $request->input('business_id'),
            'description' => $request->input('description'),
            'limit' => $request->input('limit'),
            'setTime' => $request->input('setTime'),
            'week_days' => implode(',', $request->input('week_days')),// Convert array to comma-separated string
            'date_range' => $request->input('date_range'),
            'minimum_spend' => $request->input('minimum_spend'),
            'estimated_savings' => $request->input('estimated_savings'),
            'terms' => $request->input('terms'),
            'user_id' => Auth::guard('api')->user()->id,
            'type' => 'limited perk',
            'pin' => $request->input('pin'),

        ]);
    }

    public function create_ongoing_perk(Request $request){

        // dd($request);
        $validator = Validator::make($request->all(), [
            'business_id' => 'required',
            'description' => 'required|string|max:255',
            'setTime' => 'required|string',
            'week_days' => 'nullable|array',  // week_days should be an array
            'week_days.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $existingOngoingPerks = LimitedPerks::where('business_id', $request->business_id)
        ->where('type', 'ongoing perk')
        ->where('status','!=','ended')
        ->count();

         if ($existingOngoingPerks >= 3) {
             return $this->error('error', 'A business can have a maximum of 3 ongoing perks.');
         }

        return LimitedPerks::create([
            'business_id' => $request->input('business_id'),
            'description' => $request->input('description'),
            'uses_per_month' => $request->input('uses_per_month'),
            'setTime' => $request->input('setTime'),
            'week_days' => implode(',', $request->input('week_days')),// Convert array to comma-separated string
            'minimum_spend' => $request->input('minimum_spend'),
            'estimated_savings' => $request->input('estimated_savings'),
            'terms' => $request->input('terms'),
            'user_id' => Auth::guard('api')->user()->id,
            'type' => 'ongoing perk',

        ]);
    }

    public function claim_perk($id){
        $limitedPerk = LimitedPerks::find($id);
        $userId = Auth::guard('api')->user()->id;

        if(Auth::guard('api')->user()->plan_status == 0){
            return $this->sendError('Error.', [
                "claim" => array("Not Have Permission Please subscribe first"),
            ]);
        }


        if($limitedPerk->limit >=1){
            $currentClaims = LimitedPerksUsers::where('perk_id', $id)->count();
            if ($currentClaims >= $limitedPerk->limit) {
                return $this->sendError('Error.', [
                    "claim" => array("This perk is no longer available."),
                ]);
            }


            // Check if the user has already claimed the perk
            $limitedPerkUser = LimitedPerksUsers::where('perk_id', $id)
                ->where('user_id', Auth::guard('api')->user()->id)
                ->whereDate('created_at',now()->toDateString())
                ->first();

            if ($limitedPerkUser) {
                return $this->sendError('Error.', [
                    "claim" => array("You have already claimed this perk."),
                ]);
            }
        }

        $today = now()->toDateString();

        switch ($limitedPerk->uses_per_month) {
                case 'Reusable daily' :
                case 'Daily Uses':
                // Check if the user has already claimed this perk today
                $dailyClaim = LimitedPerksUsers::where('perk_id', $id)
                    ->where('user_id', $userId)
                    ->whereDate('created_at', $today)
                    ->first();

                if ($dailyClaim) {
                    return $this->sendError('Error.', [
                        "claim" => array("You can claim this perk only once per day."),
                    ]);
                }
                break;

            case 'One time use':
                // Check if the user has ever claimed this perk
                $oneTimeClaim = LimitedPerksUsers::where('perk_id', $id)
                    ->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->where('user_id', $userId)
                    ->first();

                if ($oneTimeClaim) {
                    return $this->sendError('Error.', [
                        "claim" => array("You can claim this perk only once."),
                    ]);
                }
                break;

            default:
                // Handle numeric limits (1–35 claims per month)
                if (is_numeric($limitedPerk->uses_per_month)) {
                    $monthlyClaims = LimitedPerksUsers::where('perk_id', $id)
                        ->where('user_id', $userId)
                        ->whereYear('created_at', now()->year)
                        ->whereMonth('created_at', now()->month)
                        ->count();

                    if ($monthlyClaims >= $limitedPerk->uses_per_month) {
                        return $this->sendError('Error.', [
                            "claim" => array("You have reached the monthly limit for this perk."),
                        ]);
                    }
                }
                break;
        }

        // Allow the user to claim the perk
        $newClaim = LimitedPerksUsers::create([
            'perk_id' => $id,
            'user_id' => Auth::guard('api')->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $newClaim,
            'message' => 'Perk claimed successfully.',
        ]);

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

    public function claim_perk_list(){
        $limitedPerkUser = LimitedPerksUsers::
        where('user_id', Auth::guard('api')->user()->id)
        ->pluck('perk_id')
        ->toArray();

        $limitedPerks = LimitedPerks::
            with([
                'perkUsers' => function ($query) {
                    $query->orderBy('created_at', 'desc'); // Order perkUsers in descending order
                },
                'business'
            ])
            ->whereIn('limited_perks.id',$limitedPerkUser)
            ->join('business', 'limited_perks.business_id', '=', 'business.id')
            ->join("business_details", "business_details.business_id", "business.id")

            //     $query->leftJoin('limited_perks_users', function ($join) {
            //         $join->on('limited_perks.id', '=', 'limited_perks_users.perk_id')
            //              ->where('limited_perks_users.user_id', Auth::guard('api')->user()->id);
            //     })
            //     ->whereNull('limited_perks_users.id'); // Exclude perks already claimed by the user
            // })
            // ->whereRaw('limited_perks.claim_count < limited_perks.limit')
            ->select('limited_perks.*')
            ->distinct() // Ensure unique limited_perks.id
            ->withCount('perkUsers')
            ->get();


            foreach ($limitedPerks as $offer) {


                if($offer->type == 'limited perk'){
                    if (preg_match('/(\d+)\s+days?/', $offer->date_range, $matches)) {
                        // Handle days
                        $value = (int)$matches[1];
                        $date = date('d/m/Y 23:59', strtotime("+$value days"));
                    } elseif (preg_match('/(\d+)\s*day/', $offer->date_range, $matches)) {
                        // Handle a single day
                        $value = (int)$matches[1];
                        $date = date('d/m/Y 23:59', strtotime("+$value days"));
                    } elseif (preg_match('/(\d+)h\s*(\d+)m\s*(\d+)s/', $offer->date_range, $matches)) {
                        // Handle hours, minutes, and seconds
                        $hours = (int)$matches[1];
                        $minutes = (int)$matches[2];
                        $seconds = (int)$matches[3];
                        $date =  date('d/m/Y', strtotime("+0 days")) ." {$hours}:{$minutes}";
                    } else {
                        $date = "Invalid format";
                    }

                    $offer->expired_date = $date;

                }
                $offer->is_claimed = false; // Default value before the switch
                $offer->is_saved = false;

                $savedPerks = SavedLimitedPerks::where('user_id',Auth::guard('api')->user()->id)->where('perk_id',$offer->id)->first();
                if(!empty($savedPerks) || isset($savedPerks)){
                    $offer->is_saved = true;
                }

                if($offer->type == "ongoing perk"){
                    $userId = Auth::guard('api')->user()->id;

                    $today = now()->toDateString();


                    switch ($offer->uses_per_month) {

                        case 'Reusable daily' :
                        case 'Daily Uses':
                            // Check if the user has already claimed this perk today
                            $dailyClaim = LimitedPerksUsers::where('perk_id', $offer->id)
                                ->where('user_id', $userId)
                                ->whereDate('created_at', $today)
                                ->first();

                            if ($dailyClaim) {
                                $offer->is_claimed = true;
                            }
                            break;

                        case 'One time use':
                            // Check if the user has ever claimed this perk
                            $oneTimeClaim = LimitedPerksUsers::where('perk_id', $offer->id)
                                ->where('user_id', $userId)
                                ->first();

                            if ($oneTimeClaim) {
                                $offer->is_claimed = true;
                            }
                            break;

                        case 'No Limit':
                                $offer->is_claimed = false;
                            break;

                        default:
                            // Handle numeric limits (1–35 claims per month)
                            if (is_numeric($offer->uses_per_month)) {
                                $monthlyClaims = LimitedPerksUsers::where('perk_id', $offer->id)
                                    ->where('user_id', $userId)
                                    ->whereYear('created_at', now()->year)
                                    ->whereMonth('created_at', now()->month)
                                    ->count();

                                if ($monthlyClaims >= $offer->uses_per_month) {
                                    $offer->is_claimed = true;
                                }
                            }
                            break;
                    }
                }
                else{
                    if($offer->limit >=1){
                        $currentClaims = LimitedPerksUsers::where('perk_id', $offer->id)->count();
                        if ($currentClaims >= $offer->limit) {
                            $offer->is_claimed = true;
                        }


                        // Check if the user has already claimed the perk
                        $limitedPerkUser = LimitedPerksUsers::where('perk_id', $offer->id)
                            ->where('user_id', Auth::guard('api')->user()->id)
                            ->first();

                        if ($limitedPerkUser) {
                            $offer->is_claimed = true;
                        }
                    }

                }
                $offer->distance = round($offer->distance, 4);

                if ($offer->business->image) {

                    $offer->business_logo = env("APP_URL") . $offer->business->image;
                } else {

                    $offer->business_logo = env("APP_URL") . "images/61c1e4124e0be.jpeg";
                }

                if ($offer->business->cover_img) {

                    $offer->business_cover_img = env("APP_URL") . $offer->business->cover_img;
                } else {

                    $offer->business_cover_img = env("APP_URL") . "images/Bitmap.png";
                }

                $locations = BusinessDetails::where("business_id", $offer->business_id)

                    ->select("*")

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

                    // $location->distance = round($location->distance, 4);

                    $location->timing = $open_timing['timings'];

                    $location->location_open_time = $open_timing['current_open_time'];

                    $location->location_close_time = $open_timing['current_close_time'];

                    unset($location->open_days);

                    unset($location->open_time);

                    unset($location->close_time);


                }

                $offer->business_locations = $locations;
            }

            $data['limitedPerks'] = $limitedPerks;

        // $limitedPerks = LimitedPerks::with('business')->latest()->get();
        return $this->sendResponse($limitedPerks,'');
    }

    public function saved_perk($id){
        $limitedPerk = LimitedPerks::find($id);

        $userId = Auth::guard('api')->user()->id;


        // Check if the user has already claimed the perk
        $savedLimitedPerk = SavedLimitedPerks::where('perk_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($savedLimitedPerk) {
            $savedLimitedPerk->delete();
            return response()->json([
                'success' => true,
                'message' => 'Saved Perk remove successfully.',
            ]);
        }

        // Allow the user to claim the perk
        $newSaved = SavedLimitedPerks::create([
            'perk_id' => $id,
            'user_id' => $userId,
        ]);

        return response()->json([
            'success' => true,
            'data' => $newSaved,
            'message' => 'Perk Saved successfully.',
        ]);

    }

    public function saved_perk_list(){

        $filter = request()->query('filter', 'All'); // Default to 'All'
        $userId = Auth::guard('api')->user()->id;
        $searchTerm = request()->query('search');

        $today = now()->toDateString();

        $limitedPerkUserExist = LimitedPerksUsers::
        where('user_id', Auth::guard('api')->user()->id)
        ->whereDate('created_at', Carbon::today()) // This passes today's date using Carbon
        ->whereHas('limitedPerk',function($q){
            $q->where('type','limited perk');
        })
        ->pluck('perk_id')
        ->toArray();

        $limitedPerkUser = SavedLimitedPerks::
        where('user_id', Auth::guard('api')->user()->id)
        ->pluck('perk_id')
        ->toArray();

        $query = LimitedPerks::
            with([
                'perkUsers' => function ($query) {
                    $query->orderBy('created_at', 'desc'); // Order perkUsers in descending order
                },
                'business'
            ])
            ->whereIn('limited_perks.id',$limitedPerkUser)
            ->whereNotIn('limited_perks.id',$limitedPerkUserExist)
            ->join('business', 'limited_perks.business_id', '=', 'business.id')
            ->join("business_details", "business_details.business_id", "business.id")

            //     $query->leftJoin('limited_perks_users', function ($join) {
            //         $join->on('limited_perks.id', '=', 'limited_perks_users.perk_id')
            //              ->where('limited_perks_users.user_id', Auth::guard('api')->user()->id);
            //     })
            //     ->whereNull('limited_perks_users.id'); // Exclude perks already claimed by the user
            // })
            // ->whereRaw('limited_perks.claim_count < limited_perks.limit')
            ->where('business.business_name', 'LIKE', "%{$searchTerm}%")
            ->select('limited_perks.*')
            ->distinct() // Ensure unique limited_perks.id
            ->withCount('perkUsers');
            // ->where(function ($query) use ($expirationTime) {
            //     $query->whereNull('limited_perks.expiration_date') // Handle case where expiration_day is NULL
            //           ->orWhere('limited_perks.expiration_date', '>', $expirationTime); // Compare expiration_day with calculated expiration time
            // });
            // ->get();
            if ($filter === 'Available Now') {
                $query->whereRaw("
                    limited_perks.limit > (
                        SELECT COUNT(*) FROM limited_perks_users
                        WHERE limited_perks_users.perk_id = limited_perks.id
                        AND limited_perks_users.user_id = ?
                        AND DATE(limited_perks_users.created_at) = ?
                    )
                ", [$userId, $today]);
            } elseif ($filter === 'Newest') {
                $query->orderBy('limited_perks.created_at', 'desc');
            } else {
                $query->orderBy('created_at', 'desc'); // Default sorting
            }

            // Paginate results
            $limitedPerks = $query->paginate(10);


            foreach ($limitedPerks as $offer) {


                if($offer->type == 'limited perk'){
                    if (preg_match('/(\d+)\s+days?/', $offer->date_range, $matches)) {
                        // Handle days
                        $value = (int)$matches[1];
                        $date = date('d/m/Y 23:59', strtotime("+$value days"));
                    } elseif (preg_match('/(\d+)\s*day/', $offer->date_range, $matches)) {
                        // Handle a single day
                        $value = (int)$matches[1];
                        $date = date('d/m/Y 23:59', strtotime("+$value days"));
                    } elseif (preg_match('/(\d+)h\s*(\d+)m\s*(\d+)s/', $offer->date_range, $matches)) {
                        // Handle hours, minutes, and seconds
                        $hours = (int)$matches[1];
                        $minutes = (int)$matches[2];
                        $seconds = (int)$matches[3];
                        $date =  date('d/m/Y', strtotime("+0 days")) ." {$hours}:{$minutes}";
                    } else {
                        $date = "Invalid format";
                    }

                    $offer->expired_date = $date;

                }
                $offer->is_claimed = false; // Default value before the switch
                $offer->is_saved = false;

                $savedPerks = SavedLimitedPerks::where('user_id',Auth::guard('api')->user()->id)->where('perk_id',$offer->id)->first();
                if(!empty($savedPerks) || isset($savedPerks)){
                    $offer->is_saved = true;
                }

                if($offer->type == "ongoing perk"){
                    $userId = Auth::guard('api')->user()->id;

                    $today = now()->toDateString();


                    switch ($offer->uses_per_month) {

                        case 'Reusable daily' :
                        case 'Daily Uses':
                            // Check if the user has already claimed this perk today
                            $dailyClaim = LimitedPerksUsers::where('perk_id', $offer->id)
                                ->where('user_id', $userId)
                                ->whereDate('created_at', $today)
                                ->first();

                            if ($dailyClaim) {
                                $offer->is_claimed = true;
                            }
                            break;

                        case 'One time use':
                            // Check if the user has ever claimed this perk
                            $oneTimeClaim = LimitedPerksUsers::where('perk_id', $offer->id)
                                ->where('user_id', $userId)
                                ->first();

                            if ($oneTimeClaim) {
                                $offer->is_claimed = true;
                            }
                            break;

                        case 'No Limit':
                                $offer->is_claimed = false;
                            break;

                        default:
                            // Handle numeric limits (1–35 claims per month)
                            if (is_numeric($offer->uses_per_month)) {
                                $monthlyClaims = LimitedPerksUsers::where('perk_id', $offer->id)
                                    ->where('user_id', $userId)
                                    ->whereYear('created_at', now()->year)
                                    ->whereMonth('created_at', now()->month)
                                    ->count();

                                if ($monthlyClaims >= $offer->uses_per_month) {
                                    $offer->is_claimed = true;
                                }
                            }
                            break;
                    }
                }
                else{
                    if($offer->limit >=1){
                        $currentClaims = LimitedPerksUsers::where('perk_id', $offer->id)->count();
                        if ($currentClaims >= $offer->limit) {
                            $offer->is_claimed = true;
                        }


                        // Check if the user has already claimed the perk
                        $limitedPerkUser = LimitedPerksUsers::where('perk_id', $offer->id)
                            ->where('user_id', Auth::guard('api')->user()->id)
                            ->first();

                        if ($limitedPerkUser) {
                            $offer->is_claimed = true;
                        }
                    }

                }
                $offer->distance = round($offer->distance, 4);

                if ($offer->business->image) {

                    $offer->business_logo = env("APP_URL") . $offer->business->image;
                } else {

                    $offer->business_logo = env("APP_URL") . "images/61c1e4124e0be.jpeg";
                }

                if ($offer->business->cover_img) {

                    $offer->business_cover_img = env("APP_URL") . $offer->business->cover_img;
                } else {

                    $offer->business_cover_img = env("APP_URL") . "images/Bitmap.png";
                }

                $locations = BusinessDetails::where("business_id", $offer->business_id)

                    ->select("*")

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

                    // $location->distance = round($location->distance, 4);

                    $location->timing = $open_timing['timings'];

                    $location->location_open_time = $open_timing['current_open_time'];

                    $location->location_close_time = $open_timing['current_close_time'];

                    unset($location->open_days);

                    unset($location->open_time);

                    unset($location->close_time);


                }

                $offer->business_locations = $locations;
            }

            $data['current_page'] = $limitedPerks->currentPage();
            $data['perkdata'] = $limitedPerks->items();
            $data['total'] = $limitedPerks->total();
            $data['per_page'] = $limitedPerks->perPage();
            $data['last_page'] = $limitedPerks->lastPage();
        // $limitedPerks = LimitedPerks::with('business')->latest()->get();
        return $this->sendResponse($data,'');
    }

}
