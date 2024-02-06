@extends('layouts.app')

@section('title')
    Pagina principal
@endsection

@section('content')
<article>
    <x-listar-post :posts="$posts" />
</article>
@endsection
