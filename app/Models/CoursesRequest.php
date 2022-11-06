<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

class CoursesRequest extends Model
{
    protected $table = 'courses_request';

    protected $fillable = [
        'name','email','phone','company','position','message','course_id','accept','country','payment_method','payed','coupon_id','discount','two_day_mail_sent'
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}