<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';
    
    protected $fillable = ['name', 'price', 'image', 'category_id','disable','description','type','file','link','top_month', 'brief'];

    public function category(){
        return $this->belongsTo('App\Models\Categories','category_id');
    }
}
