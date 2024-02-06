<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.Register');
    }
    public  function store(Request $request) 
    {
        // dd($request->get('name'));

        // Modificar request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validación
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|alpha_dash|unique:users,username|min:3|max:20',
            'email' => 'required|unique:users|email|max:40',
            'password' => 'required|confirmed|min:6'
        ]);

        //Almacenamiento
        User::create([
            'name' => $request->name,
            'username' => Str::lower($request->username),
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Autenticación
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        //Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
