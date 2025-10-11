<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    
      protected $table = 'business';
      
       protected $fillable = [
         'user_id',
        'business_name',
          'business_email',
            'business_number',
            'plan',
            'business_address',
        'description',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'image',
        'lat',
        'lon',
        'extra_info',
        'paid',
    ];

}
