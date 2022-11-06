<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    
    protected $fillable = 
    [
        'page_token','title','description','keywords','canonical','image'
    ];
}
