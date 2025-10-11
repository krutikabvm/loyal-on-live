<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'type',
        'img',
        'provider',
        'gender',
        'apple_token',
        'dob',
        'account_status','device_type','device_token','app_purchase_plan','app_purchase_plan_expiry','plan_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'plan_status' => 'boolean',
    ];
    
    public function getplanstatusAttribute($value)
    {
        
        if($value === null)
        {
            return false;
        }else{
            return $value == 0 ? false : true;
        }
    }

    public function getdeleteAttribute($value)
    {
        
        if($value == null)
        {
            return false;
        }else{
            return $value == 0 ? false : true;
        }
    }
    
  
    
    public function getdobAttribute($value)
    {
        if ($value!=null || $value!="")
        {
        return $value;
        }
        return null;
    }


    public function getgenderAttribute($value)
    {
        if ($value!=null || $value!="")
        {
        return $value;
        }
        return null;
    }
    
       
        public function getimgAttribute($value)
    {
        if ($value!=null || $value!="")
        {
            
          if (filter_var($value, FILTER_VALIDATE_URL)) { 
            return $value;
            }  
            
        return env("APP_URL").$value;
        }
        return "https://icon-library.com/images/default-user-icon/default-user-icon-28.jpg";
    }

}
