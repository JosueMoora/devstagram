@extends('layouts.app')

@section('title')
    Nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    
    <article class="md:flex md:items-center">
        <section class="md:w-1/2 px-10">
            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone dark:bg-transparent dark:border-slate-500 border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center ">
                @csrf
            </form>
        </section>
        <section class="md:w-1/2 p-10 bg-white dark:bg-[#1a202c] rounded-lg shadow-xl mx-6 max-md:mt-10">
            <form action="{{ route('posts.store') }}" method="POST" class="gap-5" novalidate>
                @csrf
                <label class="mb-2 block uppercase dark:text-gray-300 text-gray-500 font-bold">
                    Titulo
                    <input
                    name="title" 
                    type="text" 
                    placeholder="Titulo de la publicación"
                    class="border p-3 w-full rounded-lg dark:bg-transparent dark:border-slate-500  font-normal @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}" />
                </label>
                @error('title')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <label class="mb-2 block uppercase dark:text-gray-300 text-gray-500 font-bold">
                    Descripción
                    <textarea 
                    name="description"
                    placeholder="Descripción de la publicación"
                    class="border p-3 w-full dark:bg-transparent dark:border-slate-500 font-normal rounded-lg
                    @error('description')
                    border-red-500
                    @enderror"
                    >{{old('description')}}</textarea>
                </label>
                @error('description')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <input 
                name="image" 
                type="hidden" 
                value="{{old('image')}}"
                >
                @error('image')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                <input 
                type="submit"
                value="Crear Publicación"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg "
                >
            </form>
        </section>
    </article>
@endsection