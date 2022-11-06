<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CareerRequest;

class Meeting extends Model
{
    protected $table = 'meeting';
    
    protected $fillable = ['topic', 'start_time', 'course_id', 'disable', 'meeting_id', 'email', 'url' ];
   
    public function course()
    {
        return $this->belongsTo('App\Models\Courses','course_id');
    }

}
