<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Purchase_Scheme extends Model
{
    use HasFactory;
     protected $fillable = [
        
       "customer_id",
        "scheme_id",
        "business_id"
                        ];
       protected $table = 'customer_scheme_purchase';

}
