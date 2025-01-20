@extends('layouts.futbolFemeni')

@section('title', "Guia d'Equips")

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Guia d'Equips</h1>
    <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
        <tr>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Nombre</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Estadi</th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Títols</th>
            @auth
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Accions</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach ($equips as $equip)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('equips.show', $equip->id) }}" class="text-blue-700 hover:underline">{{ $equip->nom }}</a>
                </td>
                <td class="border border-gray-300 p-2">
                    <!-- {{ $estadis->firstWhere('id', $equip->estadi_id)->nom ?? 'Estadi no disponible' }} -->
                      {{ $equip->estadi->nom ?? 'Estadi no disponible' }}
                </td>
                <td class="border border-gray-300 p-2">{{ $equip->titols }}</td>
                @auth
                <td class="border border-gray-300 p-2 flex space-x-2">
                    <a href="{{ route('equips.show', $equip->id) }}" 
                        class="inline-block px-4 py-2 text-sm font-medium text-green-700 border border-green-700 rounded-lg hover:bg-green-700 hover:text-white focus:ring focus:ring-green-300">
                            Mostrar
                    </a>

                    @can('update', $equip)
                        <a href="{{ route('equips.edit', $equip->id) }}" 
                        class="inline-block px-4 py-2 text-sm font-medium text-blue-700 border border-blue-700 rounded-lg hover:bg-blue-700 hover:text-white focus:ring focus:ring-blue-300">
                                Editar
                        </a>
                    @endcan

                    @can('delete', $equip)
                    <form action="{{ route('equips.destroy', $equip->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este equipo?');" class="inline-block">
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
@can('create', App\Models\Equip::class)
<div class="mb-4">
    <a href="{{ route('equips.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Afegir Equip
    </a>
</div>
@endcan
@endauth
<div class="mt-4">
    {{ $equips->links() }}
</div>
@endsection
