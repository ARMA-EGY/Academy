<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $table = 'qr_code';
    
    protected $fillable = ['title', 'description', 'image'];

    public function category(){
        return $this->belongsTo('App\Models\Categories','category_id');
    }
}
