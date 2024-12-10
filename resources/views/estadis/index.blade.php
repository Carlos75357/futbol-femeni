@extends('layouts.app')

@section('title', "Guia d'Equips")

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Estadis de Futbol Femení</h1>
    <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
        <tr>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Nom</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Ciutat</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Capacitat</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Accions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estadis as $estadi)
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="border border-gray-200 p-4">
                <a href="{{ route('estadis.show', $estadi->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                    {{ $estadi->nom }}
                </a>
            </td>
            <td class="border border-gray-200 p-4">{{ $estadi->ciutat }}</td>
            <td class="border border-gray-200 p-4">{{ $estadi->capacitat }}</td>
            <td class="border border-gray-300 p-2 flex space-x-2">
                <a href="{{ route('estadis.show', $estadi->id) }}" 
                    class="inline-block px-4 py-2 text-sm font-medium text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring focus:ring-green-300">
                        Mostrar
                </a>

                <a href="{{ route('estadis.edit', $estadi->id) }}" 
                class="inline-block px-4 py-2 text-sm font-medium text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-700 hover:text-white focus:ring focus:ring-blue-300">
                        Editar
                </a>

                <form action="{{ route('estadis.destroy', $estadi->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este estadio?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-block px-4 py-2 text-sm font-medium text-red-700 border border-red-700 rounded-lg hover:bg-red-700 hover:text-white focus:ring focus:ring-red-300">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<br>
<div class="mb-4">
    <a href="{{ route('estadis.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Afegir Estadi
    </a>
</div>
<div class="mt-4">
    {{ $estadis->links() }}
</div>
@endsection