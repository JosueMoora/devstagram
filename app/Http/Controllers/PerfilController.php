<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        return view('profile.index');
    }

    public function store (Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'alpha_dash', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:editar-perfil'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:40'],
        ]);
        $usuario = User::find(auth()->user()->id);

        if($request->oldPassword || $request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            // verificar que el campo oldPassword sea igual a la contraseña actual
            if($request->oldPassword == $request->password) {
                return back()->with('mensaje', 'La Nueva Contraseña no puede ser igual a la Anterior');
            }
            if(Hash::check($request->oldPassword, auth()->user()->password)){
                $usuario->password = Hash::make($request->password);
                $usuario->save();
            } else {
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        }
        
        if($request->image) {
            $imagen = $request->file('image');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::configure(['driver' => 'imagick']);
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('profiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
            
        }
        
        //Guardar cambios
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->image = $nombreImagen ?? auth()->user()->image ?? null;
        $usuario->save();
        
        // Redireccionar
        return redirect()->route('posts.index',$usuario->username);
    }
}
