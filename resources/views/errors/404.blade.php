@extends('layouts.futbolFemeni')

@section('title', "Guia de Jugadores")

@section('content')
<div class="text-center">
    <h1 class="text-9xl font-bold text-indigo-600">404</h1>
    <p class="text-2xl md:text-3xl font-medium text-gray-800 mt-4">Oops! Página no encontrada</p>
    <p class="text-gray-600 mt-2">Parece que la página que buscas no existe o ha sido movida.</p>
    <a href="{{ url('/') }}" class="inline-block mt-6 px-6 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow">
        Volver al inicio
    </a>
</div>
@endsection