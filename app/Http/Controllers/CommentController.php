<?php

namespace App\Http\Controllers;
use App\image;
use App\coment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function save(Request $request)
    {
        $user = \Auth::user();
        $comment = new coment;
        $image_id = $request->image_id;
        $content = $request->content;
        $validate = $this->validate($request,[
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string'],
            ]);
            
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        $comment->save();
       
        return redirect()->route('image.detail' , $image_id)
        ->with(['message' => 'publicado correctamente']);
    }

    public function delete($id)
    {
        $user = \Auth::user();

        $comment = Coment::find($id);
        

        if($user && $user->id == $comment->user_id  ){
            $comment->delete();
            return redirect()->route('image.detail',[
                'id' => $comment->image_id])
                ->with('message' , 'comentario borrado');
        }
    }
}
