<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'images';
    
    //relacion one to many

     public function coments()
    {
        return $this->hasMany('App\coment');
    }

     public function likes()
    {
        return $this->hasMany('App\like');
    }

    //relacion many to one
     public function user()
    {
        return $this->belongsTo('App\user','user_id');
    }

}
