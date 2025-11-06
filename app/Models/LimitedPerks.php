<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class LimitedPerks extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'user_id',
        'description',
        'limit',
        'setTime',
        'week_days',
        'date_range',
        'minimum_spend',
        'estimated_savings',
        'terms',
        'type',
        'uses_per_month',
        'pin',
        'status',
        'expiration_date',
        'end_date'
    ];

    public function business()
    {
        return $this->hasOne(Business::class,'id','business_id');
    }

    public function perkUsers(){
        return $this->hasMany(LimitedPerksUsers::class,'perk_id','id');
    }


    public function getFormattedExpirationDateAttribute()
    {
        if (!empty($this->expiration_date)) {
            $expiration_date = trim($this->expiration_date);

            if (preg_match('/\b(2[0-3]|1[0-9]):[0-5][0-9]:[0-5][0-9] (AM|PM|am|pm)\b/', $expiration_date)) {
                $expiration_date = preg_replace('/ (AM|PM|am|pm)/', '', $expiration_date);
            }

            $dateTime = DateTime::createFromFormat('d/m/Y h:i:s A', $expiration_date) 
                        ?: DateTime::createFromFormat('j/n/Y h:i:s A', $expiration_date) 
                        ?: DateTime::createFromFormat('d/m/Y H:i:s', $expiration_date) 
                        ?: DateTime::createFromFormat('j/n/Y H:i:s', $expiration_date);

            if ($dateTime instanceof DateTime) {
                return $dateTime->format('d/m/Y H:i');
            } else {
                return "Invalid date format";
            }
        } else {
            if (preg_match('/(\d+)\s+days?/', $this->date_range, $matches)) {
                $value = (int)$matches[1];
                return date('d/m/Y', strtotime("+$value days"));
            } elseif (preg_match('/(\d+)\s*day/', $this->date_range, $matches)) {
                $value = (int)$matches[1];
                return date('d/m/Y', strtotime("+$value days"));
            } elseif (preg_match('/(\d+)h\s*(\d+)m\s*(\d+)s/', $this->date_range, $matches)) {
                $hours = (int)$matches[1];
                $minutes = (int)$matches[2];
                $seconds = (int)$matches[3];
                return date('d/m/Y', strtotime("+0 days")) . " {$hours}h {$minutes}m {$seconds}s";
            } else {
                return "Invalid format";
            }
        }
    }

    public function getPerkStatusAttribute()
    {
        // Handle expiration_date if set

        if($this->status == 'ended'){
            return 'ended';
        }
        
        if (!empty($this->expiration_date)) {
            $expiration_date = trim($this->expiration_date);
                // Try parsing with Carbon using correct format
                try {
                    $dateTime = Carbon::createFromFormat('d/m/Y h:i:s a', $expiration_date,'Asia/Kolkata');
                } catch (\Exception $e) {
                    $dateTime = null;
                }

                if ($dateTime instanceof Carbon) {
                    $now = Carbon::now('Asia/Kolkata');
                    if ($now->greaterThan($dateTime)) {
                        return 'ended';
                    } elseif ($now->lessThan($dateTime)) {
                        return 'live';
                    }
                }

            return 'scheduled';
        }

        // If using date_range instead
        if (!empty($this->date_range)) {
            return 'scheduled';
        }

        if($this->status != null){
            return $this->status;
        }
        else{
            return 'live';
        }
    }

}
