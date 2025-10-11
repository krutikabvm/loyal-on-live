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
use Validator;

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

}
