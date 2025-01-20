@extends('layouts.futbolFemeni')

@section('title', "Guia de jugadors")

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Jugadors de Futbol Femení</h1>
    <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
        <tr>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Data de Naixement</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Equip</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Posició</th>
            @auth
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Accions</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach($jugadors as $jugador)
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="border border-gray-200 p-4">
                <a href="{{ route('jugadors.show', ['jugador' => $jugador]) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                    {{ $jugador['nom']}}
                </a>
            </td>
            <td class="border border-gray-200 p-4">{{ $jugador['equip']->nom }}</td>
            <td class="border border-gray-200 p-4">{{ $jugador['posicio'] }}</td>
            @auth
            <td class="border border-gray-300 p-2 flex space-x-2">
                <a href="{{ route('jugadors.show', $jugador->id) }}" 
                    class="inline-block px-4 py-2 text-sm font-medium text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring focus:ring-green-300">
                        Mostrar
                </a>
                @can('update', $jugador)
                <a href="{{ route('jugadors.edit', $jugador->id) }}" 
                class="inline-block px-4 py-2 text-sm font-medium text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-700 hover:text-white focus:ring focus:ring-blue-300">
                        Editar
                </a>
                @endcan

                @can('delete', $jugador)
                <form action="{{ route('jugadors.destroy', $jugador->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este jugador?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-block px-4 py-2 text-sm font-medium text-red-700 border border-red-700 rounded-lg hover:bg-red-700 hover:text-white focus:ring focus:ring-red-300">
                        Eliminar
                    </button>
                </form>
                @endcan
            </td>
            @endauth
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<br>
@auth
@can('create', App\Models\Jugador::class)
<div class="mb-4">
    <a href="{{ route('jugadors.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Afegir Jugador
    </a>
</div>
@endcan
@endauth
<div class="mt-4">
    {{ $jugadors->links() }}
</div>
@endsection
