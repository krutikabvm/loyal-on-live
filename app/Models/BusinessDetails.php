<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetails extends Model
{
    use HasFactory;
      protected $table = 'business_details';
      
      protected $fillable = [
         'business_id',
        'address',
        'lat',
        'lon',
        'country',
        'city',
        'open_time',
         'close_time',
        'open_days',
    ];

}
