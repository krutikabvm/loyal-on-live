<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLoyaltyClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "loyalty_id",
        "business_id",
        "collected_stamps",
        "claim",
    ];
    protected $table = 'customer_loyalty_claims';
}
