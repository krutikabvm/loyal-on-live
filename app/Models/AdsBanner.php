<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsBanner extends Model
{
    use HasFactory;

    protected $table = 'ads_banners';

    protected $fillable = [
        'img',
       'advert_name',
       'url',
       'clicks'
    ];

}
