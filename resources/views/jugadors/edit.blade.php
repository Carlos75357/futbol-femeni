@extends('layouts.futbolFemeni')
@section('title', " Guia de Jugadors" )
@section('content')
<form action="{{ route('jugadors.update', $jugador->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom:</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom', $jugador->nom) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('nom') border-red-500 @enderror">
        @error('nom')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="posicio" class="block text-sm font-medium text-gray-700 mb-2">Posició:</label>
        <select id="posicio" name="posicio" required class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" value="{{ old('posicio', $jugador->posicio) }}">
            <option value="">-- Selecciona una opció --</option>
            <option value="Portero" {{ old('posicio', $jugador->posicio) == 'Portero' ? 'selected' : '' }}>Portero</option>
            <option value="Defensa" {{ old('posicio', $jugador->posicio) == 'Defensa' ? 'selected' : '' }}>Defensa</option>
            <option value="Centrocampista" {{ old('posicio', $jugador->posicio) == 'Centrocampista' ? 'selected' : '' }}>Centrocampista</option>
            <option value="Delantero" {{ old('posicio', $jugador->posicio) == 'Delantero' ? 'selected' : '' }}>Delantero</option>
        </select>
    </div>


    <div class="mb-4">
        <label for="equip_id" class="block text-sm font-medium text-gray-700 mb-1">Equip:</label>
        <select name="equip_id" id="equip_id" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('equip_id') border-red-500 @enderror">
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ $equip->id == $jugador->equip_id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
        @error('equip_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto:</label>
        <input type="file" name="foto" id="foto"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        @if ($jugador->foto)
            <p class="mt-2 text-sm text-gray-500">Foto actual:</p>
            <img src="{{ asset('storage/' . $jugador->foto) }}" alt="Foto de {{ $jugador->nom }}" class="h-16 mt-2 rounded-lg">
        @endif
    </div>

    <div class="mb-4">
        <label for="dorsal" class="block text-sm font-medium text-gray-700 mb-1">Dorsal:</label>
        <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugador->dorsal) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('dorsal') border-red-500 @enderror">
        @error('dorsal')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        Actualitzar Jugador
    </button>
</form>
@endsection
