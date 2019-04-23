<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $table = 'likes';

    //relacion many to one

     public function image()
    {
        return $this->belongsTo('App\image','image_id');
    }

    //relacion many to one

     public function user()
    {
        return $this->belongsTo('App\user','user_id');
    }

}
