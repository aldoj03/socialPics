<?php

namespace App\Http\Controllers;

use App\like;
use Illuminate\Http\Request;


class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {
        $user = \Auth::user();
        $like = new Like;
        $isset_like = Like::where('image_id' , (int)$image_id)
        ->where('user_id', $user->id)->count();
        if($isset_like == 0){
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            $like->save();
             return response()->json([
                'like' => $like,
                'message' => 'like guardado'
            ]); 
        }
    }

    public function dislike($image_id)
    {
        
         $user = \Auth::user();
        $like = Like::where('image_id' , (int)$image_id)
        ->where('user_id', $user->id)
        ->first();
        if($like){
            $like->delete();
            return response()->json([
                'like' => $like,
                'message' => 'has dado dislike'
            ]);
        }
        
    } 
}
