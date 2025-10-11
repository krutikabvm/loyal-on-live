<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme_Scan_time extends Model
{
    use HasFactory;
    
     protected $fillable = ['customer_id','loyalty_id',"business_id"];
    
    protected $table = 'scheme__scan_times';
    
  
}
