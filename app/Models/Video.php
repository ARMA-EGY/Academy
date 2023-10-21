<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

use LaravelLocalization;

class Video extends Model
{
    protected $table = 'course_videos';
    
    protected $fillable = ['course_id' ,'name', 'path'];
    
	public function course()
	{
	    return $this->belongsTo(Course::class, 'course_id', 'id');
	}

}
