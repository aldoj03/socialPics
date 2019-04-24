<?php

namespace App\Http\Controllers;

use auth;
use App\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request) 
    {   
        $description = $request->input('description');
        $image_path = $request->file('image_path');
        $validate = $this->validate($request,[
            'description' => ['required'],
            'image_path' => ['mimes:jpeg,png', 'max:10000'] ,
            ]);

            if($image_path){                            
                //poner nombre unico
                $image_name = time().$image_path->getClientOriginalName();
    
                //guardar en la carpeta storage
                Storage::disk('images')->put($image_name, File::get($image_path));
        
        
    }
    $user = \Auth::user();
    $image = new Image;
    $image->description = $description;
    $image->image_path = $image_name;
    $image->user_id = $user->id;
    $image->save();
}
}
