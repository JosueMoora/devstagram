@extends('layouts.app')


@section('title')
    Inicia sesión en DevStagram 
@endsection

@section('content')
<article class="md:flex md:justify-center md:gap-10 md:items-center">
    <section class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuario">
    </section>
    <section class="md:w-4/12 bg-white dark:bg-[#1a202c] p-6 rounded-lg shadow-xl mx-6">
        <form class="gap-5" method="POST" action="{{route('login')}}" novalidate>
            @csrf
            @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{ session('mensaje') }}
                </p>
            @endif
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

            <label class=" mb-2 block text-gray-500 text-sm" >
                <input type="checkbox" name="remember">
                     Mantener mi sesión abierta
            </label>

            {{-- Boton --}}
            <input 
            type="submit"
            value="Iniciar sesion"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg "
            >
        </form>
    </section>
</article>
@endsection