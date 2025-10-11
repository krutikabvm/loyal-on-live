<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loyalty_location extends Model
{
    use HasFactory;
    
      protected $fillable = [
        
       "business_id",
      "key",
      "stamp_id"
                        ];
      protected $table = 'loyalty_locations';
}
