<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Business;
use App\Models\Customer_Loyalty;
use App\Models\Customer_Purchase_Scheme;
use App\Models\Loyalty_Scheme;
use App\Models\Scheme_Scan_time;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CustomerLoyaltyController extends BaseController
{
    //

    public function __construct()
    {
        //dd('s');
        $this->user = Auth::guard('api')->user();
    }

    public function index(Request $request)
    {
        $currentDate = date_create(now());
        // $currentDate = date('Y-m-d', strtotime($currentDate));
        //dd($this->user->id);
        $details = DB::table("customer_loyalty")
            ->join("loyalty_scheme", "loyalty_scheme.id", "customer_loyalty.loyalty_id")
            ->join("business", "business.id", "customer_loyalty.business_id")
            ->select("loyalty_scheme.*", "customer_loyalty.collected_stamps", "customer_loyalty.id as customer_loyalty_id", "business.cover_img", 'business.image as bimg', "business.business_name", "customer_loyalty.updated_at as c_updated_at")
            ->where("customer_loyalty.claim", 0)
            ->where("customer_loyalty.deleted_at", null)
            ->where('customer_id', $this->user->id)
            ->whereIn('business.user_id',function($query){
                $query->from('users')->select('users.id')->whereColumn('users.id','business.user_id')
                ->where('users.delete',0)
                ->where('users.account_status','active');
            })
            ->orderBy('updated_at', 'DESC')
            ->get();
            
        $comp = [];
        $incomp = [];

        foreach ($details as $detail) {

            if ($detail->img != null) {
                $detail->img = env("APP_URL") . $detail->img;
            } else {
                $detail->img = env("APP_URL") . "images/61c1e4124e0be.png";
            }

            if ($detail->bimg != null) {
               $detail->bimg = env("APP_URL") . $detail->bimg;
            } else {

                $detail->bimg = env("APP_URL") . "images/61c1e4124e0be.png";
            }

            if ($detail->cover_img != null) {
                $detail->cover_img = env('APP_URL') . $detail->cover_img;
            } else {

               $detail->cover_img = env("APP_URL") . "images/Bitmap.png";
            }

            $detail->business_background = $detail->cover_img;
            $detail->scheme_cover_image = $detail->img;
            $detail->business_logo = $detail->bimg;
            // $detail['scheme_name']=$detail['name'];

            unset($detail->name);
            // unset($detail['offer_expiry']);
            unset($detail->bimg);
            unset($detail->img);
            unset($detail->cover_img);
           // $detail->offer_expiry = 'aa';
            //   start

            $scheme_purchase = Customer_Purchase_Scheme::where([['scheme_id', $detail->id], ['customer_id', $this->user->id]])->first();
            if ($scheme_purchase) {
                $detail->is_lock = false;
            } else {
                $detail->is_lock = true;
            }

            // end

            if ($detail->number_stamps <= $detail->collected_stamps) {
                // dd($details);
                $date1 = date_create($detail->c_updated_at);

                $interval = date_diff($date1, $currentDate);

                $days = $interval->format("%a");
                //
                $detail->expiry_days = 30 - $days;

                if ($days <= 30) {
                    if ((30 - $days) == 0)
                    {
                        $comp[] = $detail;
                    }else{
                         $comp[] = $detail;
                    }
                   
                }else{
                   $comp[] = $detail;
                }
                
            } else {
                $detail->expiry_days = null;
                $incomp[] = $detail;
            }

        }

        $data['collected_stamps'] = $incomp;
        $data['claim_reward'] = $comp;

        // dd($details);
        if ($details) {
            return $this->sendResponse($data, 'Customer Offers retrieved successfully.');
        } else {
            return $this->sendError('', ['No data exist']);
        }
    }

    public function single_offer(Request $request, $id)
    {

        $details = Customer_Loyalty::where('customer_id', $this->user->id)
            ->where("loyalty_id", $id)
            ->first();
        $data = [];

        if ($details) {

            $offer = DB::table("loyalty_scheme")
                ->join("business", "business.id", "loyalty_scheme.business_id")
                ->join("customer_loyalty", "customer_loyalty.business_id", "business.id")
                ->select("loyalty_scheme.*", "business.image as bimg", "business.cover_img", "customer_loyalty.collected_stamps as obtain_number_of_stamps")->first();
            // dd($offer->img);
            if ($offer->img != null) {
                $offer->img = env("APP_URL") . $offer->img;
            } else {

                $offer->img = env("APP_URL") . "images/61c1e4124e0be.png";
            }

            if ($offer->bimg != null) {
                $offer->bimg = env("APP_URL") . $offer->bimg;
            } else {

                $offer->bimg = env("APP_URL") . "images/61c1e4124e0be.png";
            }

            if ($offer->cover_img != null) {
                $offer->cover_img = env('APP_URL') . $offer->cover_img;
            } else {

                $offer->cover_img = env("APP_URL") . "images/Bitmap.png";
            }
            $offer->total_number_of_stamps = $offer->number_stamps;

            $offer->business_background = $offer->cover_img;
            $offer->scheme_logo = $offer->img;
            $offer->business_logo = $offer->bimg;
            $offer->scheme_name = $offer->name;

            unset($offer->number_stamps);
            unset($offer->name);
            unset($offer->bimg);
            unset($offer->img);
            unset($offer->cover_img);

            $data['offer_details'] = $offer;
        } else {

            $details = DB::table("loyalty_scheme")
                ->where("id", $id)
                ->select("number_stamps as total_number_of_stamps")
                ->first();
            if ($details) {
                $details->obtain_number_of_stamps = 0;
                $data['offer_details'] = $details;
            } else {

                return $this->sendError('No Customer Loyalty Fetch .');
            }
        }

        $approved = DB::table("loyalty_scheme")
            ->join("business", "business.id", "loyalty_scheme.business_id")
            ->where("loyalty_scheme.status", "approved")
            ->where("loyalty_scheme.id", $id)
            ->count();

        $data['total_approved'] = $approved;

        $desc = DB::table("loyalty_scheme")
            ->where("id", $id)
            ->first();

        $data['scheme_id'] = $id;
        $data['scheme_description'] = $desc->description;

        return $this->sendResponse($data, 'Customer Loyalty Fetch successfully.');
    }

    public function increment_stamp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nfc_id' => "required|exists:nfc_tags,nfc_detail",
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $mee = User::find($this->user->id);
         \Log::info($mee);
        if ($mee->plan_status == true) {
            $nfc_tag = DB::table("nfc_tags")->where("nfc_detail", $request->nfc_id)
                ->first();

            $id = $nfc_tag->loyalty_id;
            $business_id = $nfc_tag->business_id;
            $business_details = Business::where("id", $business_id)->first();
            $user = User::where("id", $business_details->user_id)->first();

            if ($user->account_status != 'active') {
                return $this->sendError("Account is not active yet", $business_details);
            }
            if ($user->delete == 1) {
                return $this->sendError("Account deactivated", $business_details);
            }
            $check = Customer_Loyalty::where("customer_id", $this->user->id)
                ->where("loyalty_id", $id)
                ->first();

            $total_stamp = loyalty_scheme::find($id);
            $expiry_date = date('Y-m-d', strtotime($total_stamp->offer_expiry));
            \Log::info($total_stamp);

            // $scheme_purchase = Customer_Purchase_Scheme::where([['scheme_id', $id], ['customer_id', $this->user->id]])->first();
            // if (!empty($scheme_purchase)) {
            //     return $this->sendError("You Not Are Premium", $business_details);
            // }
            
             $limit_scan_check = Customer_Purchase_Scheme::where([
            ['customer_id', $this->user->id],
            ['scheme_id',  $nfc_tag->loyalty_id],
            ])
            ->whereDate('created_at', now())->get();

            if (count($limit_scan_check) >= $total_stamp->stamps_per_day) {
                return $this->sendError("Loyalty card daily limit exceeds, please try again tomorrow", $business_details);
            }
            

            $current_date = date('Y-m-d');
            $expired = $current_date > $expiry_date;

            $detail_obj = [];
            $detail_obj['business_name'] = $business_details->business_name;
            $detail_obj['scheme_name'] = $total_stamp->name;
            $detail_obj['is_logo'] = $total_stamp->is_logo;

            if ($business_details->cover_img != null) {
                $detail_obj['business_background'] = env("APP_URL") . $business_details->cover_img;
            } else {
                $detail_obj['business_background'] = env("APP_URL") . "images/Bitmap.png";
            }

            if ($business_details->image != null) {
                $detail_obj['business_logo'] = env("APP_URL") . $business_details->image;
            } else {
                $detail_obj['business_logo'] = env("APP_URL") . "images/61c1e4124e0be.png";
            }

            if ($total_stamp->img != null) {
                $detail_obj['scheme_logo'] = env("APP_URL") . $total_stamp->img;
            } else {
                $detail_obj['scheme_logo'] = env("APP_URL") . "images/61c1e4124e0be.png";
            }

            $detail_obj['total_stamps'] = $total_stamp->number_stamps;
            $detail_obj['already_collected '] = false;
            if ($check) {
                $detail_obj['collected_stamps'] = $check->collected_stamps;
            } else {

                $detail_obj['collected_stamps'] = 0;
            }
            $detail_obj['description'] = $total_stamp->description;
            $detail_obj['other_description'] = $total_stamp->other_description;
            $detail_obj['offer_expiry'] = $expiry_date;

            if ($check) {
                $daily_count = Scheme_Scan_time::where("customer_id", $this->user->id)
                    ->where("loyalty_id", $id)
                    ->where('updated_at', '>', Carbon::parse('-10 hours'))->orderby('id', 'desc')->limit(1)
                    ->count();

                if ($daily_count >= $total_stamp->stamps_per_day) {
                    $detail_obj['already_collected '] = true;
                    return $this->sendError("Stamp collection limit reached, please try again tomorrow", $detail_obj);
                }

                if ($total_stamp->number_stamps > $check->collected_stamps) {

                    Customer_Loyalty::where("customer_id", $this->user->id)
                        ->where("loyalty_id", $id)->increment('collected_stamps');
                    Customer_Loyalty::where("customer_id", $this->user->id)
                        ->where("loyalty_id", $id)->increment('total_collected_stamps');
                    $message = "Customer Loyalty Stamp incremented successfully.";
                    Scheme_Scan_time::create([
                        "customer_id" => $this->user->id,
                        "loyalty_id" => $id,
                        "business_id" => $business_id,
                    ]);
                    $detail_obj['collected_stamps'] = $detail_obj['collected_stamps'] + 1;
                    $date_now = Carbon::parse($check['updated_at'])->addDay(30);
                    $days = now()->diff($date_now)->days;
                    $new_days = (now() == $date_now or now() > $date_now) ? 0 : $days;
                    $detail_obj['ads_expiry'] = $new_days == 0 ? 'Expired' : 'Expires in ' . ($new_days + 1) . ' Days';
                } elseif ($total_stamp->number_stamps == $check->collected_stamps) {

                    $date_now = Carbon::parse($check['updated_at'])->addDay(30);

                    $days = now()->diff($date_now)->days;
                    $new_days = (now() == $date_now or now() > $date_now) ? 0 : $days;
                    $detail_obj['ads_expiry'] = $new_days == 0 ? 'Expired' : 'Expires in ' . ($new_days + 1) . ' Days';
                    $new_days == 0 ? $check->delete() : '';
                    $message = "Congrats you have completed scheme.";

                }

                $user = Customer_Loyalty::where("customer_id", $this->user->id)
                    ->where("loyalty_id", $id)
                    ->first();
            } else {
                $user = Customer_Loyalty::create([
                    'customer_id' => $this->user->id,
                    "loyalty_id" => $id,
                    "collected_stamps" => 1,
                    "total_collected_stamps" => 1,
                    "business_id" => $business_id,
                ]);
                Scheme_Scan_time::create([
                    "customer_id" => $this->user->id,
                    "loyalty_id" => $id,
                    "business_id" => $business_id,
                ]);
                $message = "Customer Loyalty Stamp added successfully.";

                $detail_obj['collected_stamps'] = $detail_obj['collected_stamps'] + 1;
            }
            $detail_obj['customer_loyalty_id'] = $user->id;
            $user->nfc_tag = $request->nfc_id;

            return $this->sendResponse(
                $detail_obj,
                $message
            );
        } else {
            return $this->checkPurchase($request);
            // $my_nfc_tag = DB::table("nfc_tags")->where("nfc_detail", $request->nfc_id)->first();
            // $already_purchase = Customer_Purchase_Scheme::where([
            //         ['business_id', $my_nfc_tag->business_id],
            //         ['customer_id', $this->user->id] ,
            //         ['scheme_id', $my_nfc_tag->loyalty_id]])->first();

            // if (!$already_purchase) {
            //     checkPurchase($request);
            // } else {
            //     return $this->sendError('Please buy premium membership');
            // }
        }
    }

    public function checkPurchase(Request $request)
    {
        $nfc_tag = DB::table("nfc_tags")->where("nfc_detail", $request->nfc_id)
            ->first();

        $id = $nfc_tag->loyalty_id;
        $business_id = $nfc_tag->business_id;
        $business_details = Business::where("id", $business_id)->first();
        $user = User::where("id", $business_details->user_id)->first();
        $already_purchase = Customer_Purchase_Scheme::where([
            ['business_id', $nfc_tag->business_id],
            ['customer_id', $this->user->id],
            ['scheme_id', $nfc_tag->loyalty_id],
        ])->first();

        if ($user->account_status != 'active') {
            return $this->sendError("Account is not active yet", $business_details);
        }
        if ($user->delete == 1) {
            return $this->sendError("Account deactivated", $business_details);
        }

        $Customer_Purchase_Scheme_ok = Customer_Purchase_Scheme::where([
            ['customer_id', $this->user->id],
            ['scheme_id', '!=', $nfc_tag->loyalty_id],
        ])
            ->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), now()->format('Y-m-d'))->get();

        if (count($Customer_Purchase_Scheme_ok) > 0) {
            return $this->sendError("Please Purchase a plan for more Loyalty card", $business_details);
        }

        $check = Customer_Loyalty::where("customer_id", $this->user->id)
            ->where("loyalty_id", $id)
            ->first();

        $total_stamp = loyalty_scheme::find($id);
        
        
          $limit_scan_check = Customer_Purchase_Scheme::where([
            ['customer_id', $this->user->id],
            ['scheme_id',  $nfc_tag->loyalty_id],
        ])
            ->whereDate('created_at', now())->get();

        if (count($limit_scan_check) >= $total_stamp->stamps_per_day) {
            return $this->sendError("Loyalty card daily limit exceeds, please try again tomorrow", $business_details);
        }
        $expiry_date = date('Y-m-d', strtotime($total_stamp->offer_expiry));

        $current_date = date('Y-m-d');
        $expired = $current_date > $expiry_date;

        $detail_obj = [];
        $detail_obj['business_name'] = $business_details->business_name;
        $detail_obj['scheme_name'] = $total_stamp->name;
        $detail_obj['is_logo'] = $total_stamp->is_logo;

        if ($business_details->cover_img != null) {
            $detail_obj['business_background'] = env("APP_URL") . $business_details->cover_img;
        } else {
            $detail_obj['business_background'] = env("APP_URL") . "images/Bitmap.png";
        }

        if ($business_details->image != null) {
            $detail_obj['business_logo'] = env("APP_URL") . $business_details->image;
        } else {
            $detail_obj['business_logo'] = env("APP_URL") . "images/61c1e4124e0be.png";
        }

        if ($total_stamp->img != null) {
            $detail_obj['scheme_logo'] = env("APP_URL") . $total_stamp->img;
        } else {
            $detail_obj['scheme_logo'] = env("APP_URL") . "images/61c1e4124e0be.png";
        }

        $detail_obj['total_stamps'] = $total_stamp->number_stamps;
        $detail_obj['already_collected '] = false;
        if ($check) {
            $detail_obj['collected_stamps'] = $check->collected_stamps;
        } else {
            $mycheck = Customer_Loyalty::where("customer_id", $this->user->id)->first();
            if ($mycheck) {
                $check_loyal_id = $mycheck->loyalty_id;
                $check_business_id = $mycheck->business_id;

                // if ($check_loyal_id != $id || $check_business_id != $business_id) {
                //     return $this->sendError("To unlock all loyalty cards, go premium!");
                // }
            } else {
                if (!$already_purchase) {

                    $purchaseObj = [];
                    $purchaseObj["isOneRewardCollected"] = true;
                    $purchaseObj["scheme_id"] = $id;
                    $purchaseObj["business_id"] = $business_id;
                    $purchaseObj["customer_id"] = $this->user->id;
                    $customer_scheme_purchase = Customer_Purchase_Scheme::create($purchaseObj);
                }
            }
            $detail_obj['collected_stamps'] = 0;
        }
        $detail_obj['description'] = $total_stamp->description;
        $detail_obj['other_description'] = $total_stamp->other_description;

        $detail_obj['offer_expiry'] = $expiry_date;

        if ($check) {
            $daily_count = Scheme_Scan_time::where("customer_id", $this->user->id)
                ->where("loyalty_id", $id)
                ->where('updated_at', '>', Carbon::parse('-10 hours'))->orderby('id', 'desc')->limit(1)
                ->count();

            // if ($daily_count >= $total_stamp->stamps_per_day) {
            //     $detail_obj['already_collected '] = true;
            //     return $this->sendError("Stamp collection limit reached, please try again tomorrow", $detail_obj);
            // }

            if ($total_stamp->number_stamps > $check->collected_stamps) {

                Customer_Loyalty::where("customer_id", $this->user->id)
                    ->where("loyalty_id", $id)->increment('collected_stamps');
                Customer_Loyalty::where("customer_id", $this->user->id)
                    ->where("loyalty_id", $id)->increment('total_collected_stamps');
                $message = "Customer Loyalty Stamp incremented successfully.";
                Scheme_Scan_time::create([
                    "customer_id" => $this->user->id,
                    "loyalty_id" => $id,
                    "business_id" => $business_id,
                ]);
                $detail_obj['collected_stamps'] = $detail_obj['collected_stamps'] + 1;
                $date_now = Carbon::parse($check['updated_at'])->addDay(30);
                $days = now()->diff($date_now)->days;
                $new_days = (now() == $date_now or now() > $date_now) ? 0 : $days;
                $detail_obj['ads_expiry'] = $new_days == 0 ? 'Expired' : 'Expires in ' . ($new_days + 1) . ' Days';
            } elseif ($total_stamp->number_stamps == $check->collected_stamps) {

                $date_now = Carbon::parse($check['updated_at'])->addDay(30);

                $days = now()->diff($date_now)->days;
                $new_days = (now() == $date_now or now() > $date_now) ? 0 : $days;
                $detail_obj['ads_expiry'] = $new_days == 0 ? 'Expired' : 'Expires in ' . ($new_days + 1) . ' Days';
                $new_days == 0 ? $check->delete() : '';
                $message = "Congrats you have completed scheme.";
            }

            $user = Customer_Loyalty::where("customer_id", $this->user->id)
                ->where("loyalty_id", $id)
                ->first();
        } else {
            $user = Customer_Loyalty::create([
                'customer_id' => $this->user->id,
                "loyalty_id" => $id,
                "collected_stamps" => 1,
                "total_collected_stamps" => 1,
                "business_id" => $business_id,
            ]);
            Scheme_Scan_time::create([
                "customer_id" => $this->user->id,
                "loyalty_id" => $id,
                "business_id" => $business_id,
            ]);
            $message = "Customer Loyalty Stamp added successfully.";

            $detail_obj['collected_stamps'] = $detail_obj['collected_stamps'] + 1;

        }
        $detail_obj['customer_loyalty_id'] = $user->id;
        $user->nfc_tag = $request->nfc_id;

        return $this->sendResponse(
            $detail_obj,
            $message
        );
    }

    public function collect_reward(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_loyalty_id' => "required|exists:customer_loyalty,id",
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Customer_Loyalty = Customer_Loyalty::find($request->customer_loyalty_id);
        if(!$Customer_Loyalty){
            return $this->sendError("Loyalty not found", []);
        }
        $scheme = loyalty_scheme::find($Customer_Loyalty['loyalty_id']);
        //dd($scheme);
       // dd($scheme->number_stamps); 
        if ($Customer_Loyalty['collected_stamps'] < $scheme->number_stamps) {

            return $this->sendError("Please collect minimum " . $scheme->number_stamps . " stamps to collect a reward", []);
        }

        $diff = now()->diffInDays(Carbon::parse(

            date('Y-m-d', strtotime($Customer_Loyalty['updated_at']))
        ));
        $detail = 30 - $diff;
        //if ($detail > 0) {

            $Customer_Loyalty->claim = $Customer_Loyalty->claim + 1;
            $Customer_Loyalty->collected_stamps = 0;

            $cust = $Customer_Loyalty;
            $check = DB::table('customer_loyalty_claims')
                ->where('customer_id', $Customer_Loyalty->customer_id)
                ->where('loyalty_id', $Customer_Loyalty->loyalty_id)
                ->where('business_id', $Customer_Loyalty->business_id)
                ->first();
            if (empty($check)) {
                DB::table('customer_loyalty_claims')->insert([
                    'customer_id' => $Customer_Loyalty->customer_id,
                    'loyalty_id' => $Customer_Loyalty->loyalty_id,
                    'business_id' => $Customer_Loyalty->business_id,
                    'collected_stamps' => $Customer_Loyalty->collected_stamps,
                    'claim' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $grt  = DB::table('customer_loyalty_claims')
                ->where('customer_id', $Customer_Loyalty->customer_id)
                ->where('loyalty_id', $Customer_Loyalty->loyalty_id)
                ->where('business_id', $Customer_Loyalty->business_id)->get();
               
                if(count($grt)>0){
                    $claim = $grt[0]->claim;
                    $collected_stamps = $grt[0]->collected_stamps;
                }else{
                    $claim = 0;
                    $collected_stamps = 0;
                }
                    DB::table('customer_loyalty_claims')
                    ->where('customer_id', $Customer_Loyalty->customer_id)
                    ->where('loyalty_id', $Customer_Loyalty->loyalty_id)
                    ->where('business_id', $Customer_Loyalty->business_id)
                    ->update([
                        //'claim' => DB::raw('`claim`') + 1,
                        'claim' => $claim + 1,
                        'collected_stamps' => $collected_stamps + $Customer_Loyalty->collected_stamps,
                        'updated_at'=>now()
                    ]);
            }
            $Customer_Loyalty->save();
            $Customer_Loyalty->delete();
            Scheme_Scan_time::where("customer_id", $Customer_Loyalty->customer_id)
                ->where("loyalty_id", $Customer_Loyalty->loyalty_id)
                ->delete();
            return $this->sendResponse($cust, "successfully Claimed");
        //} else {

          //  return $this->sendError("Loyalty Expired", []);
        //}
    }
}
