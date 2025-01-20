@extends('layouts.futbolFemeni')
@section('title', " Guia de Partits" )
@section('content')
<form action="{{ route('partits.update', $partit->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="data_partit" class="block text-sm font-medium text-gray-700 mb-2">Data partit:</label>
        <input type="date" id="data_partit" name="data_partit" value="{{ $partit->data_partit }}" placeholder="Data del partit" 
                class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
    </div>

    <div>
        <label for="resultat" class="block text-sm font-medium text-gray-700 mb-2">Resultat:</label>
        <input type="text" id="resultat" name="resultat" value="{{ $partit->gols_local }}-{{ $partit->gols_visitant }}" placeholder="Formato: local-goles, visitant-goles" 
            class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
            pattern="^\d+-\d+$"
            title="El formato debe ser numero-numero. Ejemplo: 3-2, 5-1" />
        <small class="text-gray-500">Ejemplo: 3-2, 5-1</small>
    </div>

    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        Actualitzar Partit
    </button>
</form>
@error('resultat')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
@endsection

