<!-- Vista para crear jugador -->
@extends('layouts.futbolFemeni')
@section('title', "Crear Jugador de Futbol Femení")
@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-6 text-center">Crear un Nou Jugador</h1>
    <form action="{{ route('jugadors.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom:</label>
            <input type="text" id="nom" name="nom" placeholder="Nom del jugador" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="posicio" class="block text-sm font-medium text-gray-700 mb-2">Posició:</label>
            <select id="posicio" name="posicio" 
                    class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                <option value="">-- Selecciona una opció --</option>
                <option value="Portero">Portero</option>
                <option value="Defensa">Defensa</option>
                <option value="Centrocampista">Centrocampista</option>
                <option value="Delantero">Delantero</option>
            </select>
            @error('posicio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="equip_id" class="block text-sm font-medium text-gray-700 mb-2">Equip:</label>
            <select id="equip_id" name="equip_id"
                    class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                    {{ auth()->user()->equip_id ? 'disabled' : '' }}>
                <option value="">-- Selecciona un equip --</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" {{ auth()->user()->equip_id === $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
                @endforeach
            </select>
            @if(auth()->user()->equip_id)
                <input type="hidden" name="equip_id" value="{{ auth()->user()->equip_id }}">
            @endif

            @error('equip_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="data_naixement" class="block text-sm font-medium text-gray-700 mb-2">Data de naixement:</label>
            <input type="date" id="data_naixement" name="data_naixement" placeholder="Data de naixement" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
            @error('data_naixement')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto:</label>
            <input type="file" name="foto" id="foto"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('foto')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="dorsal" class="block text-sm font-medium text-gray-700 mb-2">Dorsal:</label>
            <input type="number" id="dorsal" name="dorsal" placeholder="Dorsal" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
            @error('dorsal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" 
                    class="px-6 py-2 text-black bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md transition duration-300">
                Crear
            </button>
        </div>
    </form>
</div>
@endsection