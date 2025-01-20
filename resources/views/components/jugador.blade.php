<div class="estadi border rounded-lg shadow-md p-4 bg-white">
    @if ($foto)
        <td class="border border-gray-300 p-2">
            <img src="{{ asset('storage/' . $foto) }}" alt="Foto de {{ $nom }}" class="h-8 w-8 object-cover rounded-full">
        </td>
    @endif
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Equip:</strong> {{ json_decode($equip)->nom }}</p>
    <p><strong>Posició:</strong> {{ $posicio }}</p>
</div>
