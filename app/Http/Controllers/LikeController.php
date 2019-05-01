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


    public function index()
    {
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id )
        ->orderBy('id','desc')
        ->paginate(5);
        return view('likes.index')
        ->with(['likes' => $likes]);
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
            $count_likes = Like::where('image_id', (int)$image_id )->count();
             return response()->json([
                'like' => $like,
                'message' => 'like guardado',
                'count_likes' => $count_likes
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
             $count_likes = Like::where('image_id', (int)$image_id )->count();
            return response()->json([
                'like' => $like,
                'message' => 'has dado dislike',
                'count_likes' => $count_likes
            ]);
        }
        
    } 

    public function countlikes($image_id)
    {
        $count_like = Like::where('image_id' , (int)$image_id)->count();
        return response()->json([
            'count' => $count_like
        ]);
    }
}
