@extends('layouts.app')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <article class="container mx-auto md:flex">
        <section class="md:w-1/2 max-md:p-5">
            <img src="{{asset('uploads/'.$post->image)}}" alt="Imagen del post {{$post->title}}" class="md:w-4/5 rounded-xl object-cover">
            @auth
                <livewire:like-post :post="$post" />
            @endauth 
            <div>
                <p class="font-bold">{{$user->username}} <span class="font-normal">{{$post->description}}</span> </p>
                
                <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{route('posts.destroy', $post)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input 
                            type="submit" 
                            value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer font-bold mt-4 p-2 text-white rounded"
                        >
                    </form>
                @endif    
            @endauth
        </section>
        <section class="md:w-1/2 p-5">
            @auth
            <div class="shadow-xl rounded-lg bg-white dark:bg-[#1a202c] p-5">
                <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>
                @if (session('mensaje'))
                    <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                    
                @endif
                <form action="{{route('comments.store', ['user' => $user, 'post' => $post])}}" method="POST">
                    @csrf
                    <label class="mb-2 block uppercase text-gray-500 font-bold">
                        Comentar
                        <textarea 
                        name="comentario"
                        placeholder="Agrega un comentario"
                        class="border p-3 w-full dark:bg-transparent dark:border-slate-500  font-normal rounded-lg
                        @error('comentario')
                        border-red-500
                        @enderror"
                        ></textarea>
                    </label>
                    @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                    <input 
                        type="submit"
                        value="Publicar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg "
                    >
                </form>
            </div>
            @endauth
            <div>
                <h2 class="text-2xl font-bold my-5">Comentarios</h2>
                @if ($post->comments->count())
                    @foreach ($post->comments as $comment)
                        <div class="shadow-xl rounded-lg bg-white dark:bg-[#1a202c] p-5 my-5">
                            <a href="{{route('posts.index',$comment->user )}}">
                                <p class="font-bold">{{$comment->user->username}}</p>
                            </a>
                            <p>{{$comment->comentario}}</p>
                            <p class="text-sm text-gray-500">{{$comment->created_at->diffForHumans()}}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600 uppercase text-sm font-bold text-center ">No hay comentarios</p>
                @endif
            </div>
        </section>
    </article>
@endsection