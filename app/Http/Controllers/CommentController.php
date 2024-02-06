<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //Validar
        $this->validate($request, [
            'comentario' => 'required|max:500'
        ]);
        //Almacenar
        Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $request->post,
            'comentario' => $request->comentario
        ]);
        //Imprimir
        return back()->with('mensaje', 'Comentario creado correctamente.');
    }
}
