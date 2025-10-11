<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loyalty_Scheme extends Model
{
    use HasFactory;
      protected $fillable = [
        
       "business_id",
        "name",
        "img",
        "description",
        "number_stamps",
        "is_logo",
        "offer_expiry",
        "stamps_per_day","other_description",
        "status"
                        ];
    
      protected $table = 'loyalty_scheme';
}
