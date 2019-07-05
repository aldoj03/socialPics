<?php



namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    private $name ;
    private $surname ;
    private $nickname ;
    private $email ;
    private $image;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config()
    {
        return view('user.config');
    }


    public function getImage($filename)
    {     
    $file = Storage::disk('users')->get($filename);
    return new response($file,200);
    }
    

    public function getUpdatedata($request) {
        //conseguir usuario identificado
         $user = \Auth::user();
         
         $id = $user->id;
         //recibe la image
     $image_path = $request->file('image_path'); 

        //validar campos
        $validate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255','unique:users,nickname,'.$id],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email,'.$id],
            'image_path' => ['image', 'max:10000'] ,
            ]);
    
        //recoger datos del formulario
        $this->name = $request->input('name');
        $this->surname = $request->input('surname');
        $this->nickname = $request->input('nickname');
        $this->email = $request->input('email');

            //guarda la imagen
        if($image_path){          
           
            //borrar imagen si es diferente de guest
            if($user->image != 'guest.png'){
                Storage::disk('users')->delete($user->image);
            }
            //poner nombre unico
            $image_name = time().$image_path->getClientOriginalName();

            //guardar en la carpeta storage
            Storage::disk('users')->put($image_name, File::get($image_path));

            //pongo el nombre de la imgaen en el objeto

            $this->image = $image_name;
        }
        else{
             $this->image = $user->image;
        }
       
        return $user;
    }

    public function update(Request $request){

        $user = $this->getUpdatedata($request);
        //asignar nuevos valores

        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->image = $this->image;

        
        //realiza el update en la db
        $user->update(); 
        

        return redirect()->route('config')
        ->with(['message' => 'Usuario actualizado correctamente']);

    }

    public function profile($id)
    {
       $user = User::find($id);
       return view('user.profile')->with('user',$user);
    }
}
