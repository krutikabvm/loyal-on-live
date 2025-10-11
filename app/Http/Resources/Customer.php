<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Roles;
class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role=Roles::where("id",$this->type)->select("name")->first();
        
        return [
            "id" =>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "phone"=> $this->phone_number,
            "type" => $this->type,
            "role_name" =>$role->name,
            "dob"=>$this->dob,
            "gender"=>$this->gender,
            "img_url"=>$this->img,
        
            ];
    }
}
