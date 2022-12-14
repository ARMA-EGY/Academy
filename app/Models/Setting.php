<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    
    protected $fillable = ['project_name', 'phone', 'email', 'address', 'logo', 'dollar'];
}
