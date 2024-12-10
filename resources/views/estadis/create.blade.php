@extends('layouts.app')
@section('title', "Crear Estadi de Futbol Femení")
@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-6 text-center">Crear un Nou Estadi</h1>
    <form action="{{ route('estadis.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom:</label>
            <input type="text" id="nom" name="nom" placeholder="Nom de l'estadi" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
        </div>

        <div>
            <label for="ciutat" class="block text-sm font-medium text-gray-700 mb-2">Ciutat:</label>
            <input type="text" id="ciutat" name="ciutat" placeholder="Ciutat de l'estadi" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
        </div>

        <div>
            <label for="capacitat" class="block text-sm font-medium text-gray-700 mb-2">Capacitat:</label>
            <input type="number" id="capacitat" name="capacitat" placeholder="Capacitat màxima" 
                   class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
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
