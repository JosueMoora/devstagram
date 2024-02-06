@extends('layouts.app')

@section('title')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('content')
    <article class="md:flex md:justify-center">
        <section class="md:w-1/2 bg-white dark:bg-[#1a202c] rounded-xl shadow p-6">
            <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ session('mensaje') }}
                    </p>
                @endif
                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Username
                    <input
                    name="username" 
                    type="text" 
                    placeholder="nombre de usuario"
                    class=" border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error ('username') border-red-500 @enderror"
                    value="{{ auth()->user()->username }}" 
                    />
                </label>
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Email
                    <input
                    name="email" 
                    type="text" 
                    placeholder="Tu correo electronico"
                    class=" border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error ('email') border-red-500 @enderror"
                    value="{{ auth()->user()->email }}" 
                    />
                </label>
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Contraseña Actual
                    <input
                    name="oldPassword" 
                    type="password" 
                    placeholder="******"
                    class=" border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error ('oldPassword') border-red-500 @enderror"
                    />
                </label>
                @error('oldPassword')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Nueva Contraseña
                    <input
                    name="password" 
                    type="password" 
                    placeholder="******"
                    class=" border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error ('password') border-red-500 @enderror"
                    />
                </label>
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Repetir Nueva Contraseña
                    <input
                    name="password_confirmation" 
                    type="password" 
                    placeholder="******"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500" />
                </label>

                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Imagen de perfil
                    <input
                    name="image" 
                    type="file" 
                    accept=".jpg, .jpeg, .png"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500" 
                    />
                </label>

                <input 
                type="submit"
                value="Guardar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-3 "
                >
            </form>
        </section>
    </article>
@endsection