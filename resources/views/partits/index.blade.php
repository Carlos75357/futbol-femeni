@extends('layouts.app')

@section('title', "Guia de Partits")

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Partits de Futbol Femení</h1>
    <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
        <tr>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Data del Partit</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Equip Local</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Equip Visitant</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Resultat</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Accions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($partits as $partit)
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="border border-gray-200 p-4">
                <a href="{{ route('partits.show', $partit->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                    {{ $partit['data_partit'] }}
                </a>
            </td>
            <td class="border border-gray-200 p-4">{{ $equips->findOrFail($partit['equip_local_id'])->nom }}</td>
            <td class="border border-gray-200 p-4">{{ $equips->findOrFail($partit['equip_visitant_id'])->nom }}</td>
            <td class="border border-gray-200 p-4">{{ $partit['resultat'] }}</td>
            <td class="border border-gray-300 p-2 flex space-x-2">
                <a href="{{ route('partits.show', $partit->id) }}" 
                    class="inline-block px-4 py-2 text-sm font-medium text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring focus:ring-green-300">
                        Mostrar
                </a>

                <a href="{{ route('partits.edit', $partit->id) }}" 
                    class="inline-block px-4 py-2 text-sm font-medium text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-700 hover:text-white focus:ring focus:ring-blue-300">
                        Editar
                </a>

                <form action="{{ route('partits.destroy', $partit->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este jugador?');" class="inline-block">
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
    <a href="{{ route('partits.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Afegir Partit
    </a>
</div>
<div class="mt-4">
    {{ $partits->links() }}
</div>
@endsection

