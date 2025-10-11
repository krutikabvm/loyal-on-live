<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer_Loyalty extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable = [
        
       "customer_id",
        "loyalty_id",
        "description",
        "collected_stamps",
        "total_collected_stamps",
        "business_id",
        "claim",
                        ];
       protected $table = 'customer_loyalty';

}
