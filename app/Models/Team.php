<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';
    
    protected $fillable = ['name', 'title', 'image', 'phone', 'email', 'description', 'facebook','twitter','linkedin','instagram' ];

}