<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Business;
use App\Models\BusinessDetails;
use App\Models\Loyalty_Scheme;
use App\Models\Loyalty_location;
use DB;
class Customerloyalty extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        $nfc_detail=DB::table("nfc_tags")->where("business_id",$this->business_id)
        ->where("loyalty_id",$this->loyalty_id)
            ->first();
            
       if($nfc_detail){
           
         $loyalty=Loyalty_Scheme::where("id",$this->loyalty_id)->select("*")->first();
         if($loyalty){
             
             
         
         $business=Business::where("id",$this->business_id)->select("*")->first();
         
         if($business_location){
             
         
         $business_location=DB::table("business_details")->where("id",$nfc_detail->business_location_id)
         ->select("*")->first();
         
        if ($business_location){
         
        
        return [
            "id" =>$this->id,
            "customer_id"=>$this->customer_id,
            "customer_name"=>Auth::guard('api')->user()->name,
            "business_id"=>$business->id,
            "business_name"=>$business->business_name,
            "loyalty_id" =>$loyalty->loyalty_id,
            "loyalty_name" => $loyalty->name,
            "total_number_of_stamps"=>$loyalty->number_stamps,
            "obtain_number_of_stamps"=>$this->collected_stamps,
            "location"=>$business_location
         
        
            ];
            
        }
            }
         }   
       }else{
           
          return [ "error"=>"NFC Tag not assign"];
       }
       
       
       
    }
}
