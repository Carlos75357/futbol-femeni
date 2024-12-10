@extends('layouts.app')
@section('title', "Crear Partit de Futbol Femení")
@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-6 text-center">Crear un Nou Partit</h1>
    <form action="{{ route('partits.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="equip_local_id" class="block text-sm font-medium text-gray-700 mb-2">Equip local:</label>
            <select id="equip_local_id" name="equip_local_id" 
                    class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                <option value="">-- Selecciona un equip --</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="equip_visitant_id" class="block text-sm font-medium text-gray-700 mb-2">Equip visitant:</label>
            <select id="equip_visitant_id" name="equip_visitant_id" 
                    class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                <option value="">-- Selecciona un equip --</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="data_partit" class="block text-sm font-medium text-gray-700 mb-2">Data partit:</label>
            <input type="date" id="data_partit" name="data_partit" placeholder="Data del partit" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
        </div>

        <div>
            <label for="resultat" class="block text-sm font-medium text-gray-700 mb-2">Gols:</label>
            <input type="text" id="resultat" name="resultat" placeholder="Formato: local-goles, visitant-goles" 
                class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                pattern="^\d+-\d+$"
                title="El formato debe ser numero-numero. Ejemplo: 3-2, 5-1" />
            <small class="text-gray-500">Ejemplo: 3-2, 5-1</small>
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
