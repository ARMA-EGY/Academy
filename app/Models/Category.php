<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = ['name','description','image','disable'];

    public function courses()
    {
        return $this->hasMany(Courses::class,'category_id', 'id');
    }
}
