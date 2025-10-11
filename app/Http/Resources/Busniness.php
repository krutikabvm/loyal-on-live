<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class Busniness extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    
        
        $business_details=DB::table("business_details")->where("business_id",$this->id)->get();
        $loyalty=DB::table("loyalty_scheme")->where("business_id",$this->id)->get();
        $loyalty_locations=DB::table("loyalty_locations")->join("loyalty_scheme","loyalty_scheme.id","loyalty_locations.stamp_id")
        ->select("loyalty_locations.*","loyalty_scheme.name","loyalty_scheme.offer_expiry","loyalty_scheme.number_stamps")->where("loyalty_locations.business_id",$this->id)->get();
        $business_image=null;
        
        if($this->image){
            $business_image=env("APP_URL").$this->image;
        }else{
            $business_image=env("APP_URL")."images/61c1e4124e0be.jpeg";  
        }
        
        foreach($loyalty as $lo){
            
            if($lo->img){
                $lo->img=env("APP_URL").$lo->img;
            }else{
                $lo->img=env("APP_URL")."images/61c1e4124e0be.jpeg";
                
            }
        }
        
        
        return [
            'id' => $this->id,
            'business_name' => $this->business_name,
             'business_email'=>$this->business_email,
            'description' => $this->description,
            'image' => $business_image,
            'facebook_link' =>$this->facebook_link,
            'instagram_link' =>$this->instagram_link,
            'twitter_link' =>$this->twitter_link,
            'business_locations'=>$business_details,
            'loyalty'=>$loyalty,
            'loyalty_locations'=>$loyalty_locations,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
