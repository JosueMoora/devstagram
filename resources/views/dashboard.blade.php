@extends('layouts.app')

@section('title')
    Perfil de {{$user->name}}
@endsection

@section('content')
    <article class="flex  justify-center">
        <section class="w-full md:w-8/12 lg:w-6/12 flex max-md:flex-col items-center ">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img class="rounded-full" src="{{$user->image ? asset('profiles/'.$user->image) : asset('img/usuario.svg') }}" alt={{"imagen de $user->name"}} >
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col justify-center max-md:items-center py-10 ">
                <p class="text-gray-700 dark:text-gray-300 text-2xl font-bold capitalize mb-5 flex items-center gap-4 ">
                    {{$user->username}}
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                  </svg>
                                  
                            </a>                        
                        @endif
                    @endauth
                </p>
                <p class="text-gray-800 dark:text-gray-300 text-sm mb-3 font-bold">
                    {{$user->followers->count()}} <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count()) </span>
                </p>
                <p class="text-gray-800 dark:text-gray-300 text-sm mb-3 font-bold">
                    {{$user->followings->count()}} <span class="font-normal"> Siguiendo </span>
                </p>
                <p class="text-gray-800 dark:text-gray-300 text-sm mb-3 font-bold">
                    {{$user->posts->count()}} <span class="font-normal"> Publicaciones </span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id) 
                        @if (!$user->getFollowing(auth()->user()))                 
                            <form action="{{route('users.follow', $user)}}" method="POST">
                                @csrf
                                <input 
                                    type="submit" 
                                    class="bg-blue-600 hover:bg-blue-800 transition-colors text-white text-sm uppercase font-bold py-1 px-3 rounded-lg cursor-pointer"
                                    value="Seguir"
                                    />
                            </form>
                        @else                            
                            <form action="{{route('users.unfollow', $user)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input 
                                    type="submit" 
                                    class="bg-red-600 hover:bg-red-800 transition-colors text-white text-sm uppercase font-bold py-1 px-3 rounded-lg cursor-pointer"
                                    value="Dejar de seguir"
                                    />
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </section>
    </article>
    <article class="container mx-auto mt-10 max-md:px-4">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <x-listar-post :posts="$posts" />
    </article>
@endsection