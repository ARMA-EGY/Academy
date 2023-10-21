<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Video;

class Courses extends Model
{
    protected $table = 'courses';
    
    protected $fillable = ['name', 'price', 'image', 'category_id','disable','description','type','file','link','top_month', 'brief'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id','id');
    } 
}
