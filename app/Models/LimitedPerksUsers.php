<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitedPerksUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'perk_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    public function limitedPerk(){
        return $this->belongsTo(LimitedPerks::class,'perk_id','id');
    }
}
