@extends('layouts.app')

@section('title')
    Registrate en DevStagram
@endsection

@section('content')
    <article class="md:flex md:justify-center md:gap-10 md:items-center">
        <section class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuario">
        </section>
        <section class="md:w-4/12 bg-white dark:bg-[#1a202c] p-6 rounded-lg shadow-xl mx-6">
            <form action="{{ route('register') }}" method="POST" class="gap-5" novalidate>
                @csrf
                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Nombre
                    <input
                    name="name" 
                    type="text" 
                    placeholder="Tu nombre"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" />
                </label>
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Username
                    <input
                    name="username" 
                    type="text" 
                    placeholder="Tu Nombre de usuario"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error('username') border-red-500 @enderror"
                    value="{{ old('username') }}" />
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
                    type="email" 
                    placeholder="Tu correo electronico"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" />
                </label>
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Password
                    <input
                    name="password" 
                    type="password" 
                    placeholder="**********"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500 @error('password') border-red-500 @enderror"
                    />
                </label>
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <label class="mb-2 block uppercase text-gray-500 dark:text-gray-300 font-bold">
                    Repetir Password
                    <input
                    name="password_confirmation" 
                    type="password" 
                    placeholder="**********"
                    class="border p-3 w-full rounded-lg font-normal dark:bg-transparent dark:border-slate-500" />
                </label>

                {{-- Boton --}}
                <input 
                type="submit"
                value="Crear Cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg "
                >
            </form>
        </section>
    </article>
@endsection
