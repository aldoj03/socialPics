<?php

namespace App\Http\Controllers;

use App\coment;
use App\image;
use App\like;
use auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['Image', 'max:10000', 'required'],
            ]);
            $description = $request->input('description');  //TODO:revisar si se valida bien
            $image_path = $request->file('image_path');

        if ($image_path) {
            //poner nombre unico
            $image_name = time() . $image_path->getClientOriginalName();

            //guardar en la carpeta storage
            Storage::disk('images')->put($image_name, File::get($image_path));

        }
        $user = \Auth::user();
        $image = new Image;
        $image->description = $description;
        $image->image_path = $image_name;
        $image->user_id = $user->id;
        $image->save();

        return redirect()->route('home')
            ->with(['message' => 'imagen subida correctamente']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);

        return new Response($file);
    }

    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', ['image' => $image]);
    }

    public function delete($image_id)
    {
        $user = Auth::user();
        $image = Image::find($image_id);
        $comments = Coment::where('image_id', $image_id)->get();
        $likes = Like::where('image_id', $image_id)->get();

        if ($user && $image && $image->user_id == $user->id) {

            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {

                    $like->delete();
                }
            }

            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {

                    $comment->delete();
                }
            }

            Storage::disk('images')->delete($image->image_path);

            $image->delete();
            $message = array('message' => 'la imagen  se ha borrado');
        } else {
            $message = array('message' => 'la imagen no se ha borrado');
        }

        return redirect()->route('profile', ['id' => $user->id,
            'message' => $message]);
    }

    public function edit($image_id)
    {
        $user = Auth::user();
        $image = Image::find($image_id);

        if ($user && $image && $image->user_id == $user->id) {
            return view('image.edit', ['image' => $image]);
        } else {
            return redirect()->route('profile', ['id' => $user->id]);
        }
    }

    public function update(Request $request)
    {
        
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['Image', 'max:10000', 'required'],
            ]);

            $description = $request->input('description');
            $image = $request->file('image_path');
            $image_id = $request->input('image_id');
           
            //encontrar la imagen anterior
            
         $image_old = Image::find($image_id);
        
         if ($image) {
             //poner nombre unico
             $image_name = time() . $image->getClientOriginalName();
             
             //eliminar imagen antigua del storage
             Storage::disk('images')->delete($image_old->image_path);

             //guardar en la carpeta storage
             Storage::disk('images')->put($image_name, File::get($image));
             $image_old->image_path = $image_name;
             $image_old->description = $description;
             
             $image_old->save();
             
             return redirect()->route('profile', ['id' => Auth::user()->id])
             ->with(['message' => 'imagen editada correctamente']);
        }
        else{
            return redirect()->route('profile', ['id' => Auth::user()->id])
             ->with(['message' => 'error al editar imagen']);
        }
 

    }
}
