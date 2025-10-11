<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = ['name','id'];
    
    protected $table = 'roles';
    
    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
