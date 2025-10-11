<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAppSettings extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','notifications'];
    
    protected $table = 'user_app_settings';
   
}
