<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coment extends Model
{
    protected $table = 'coments';

    //relacion many to one

     public function user()
    {
        return $this->belongsTo('app\user', 'user_id');
    }

    //relacion many to one

     public function image()
    {
        return $this->belongsTo('app\image', 'image_id');
    }
}
