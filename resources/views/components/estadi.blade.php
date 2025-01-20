<div class="estadi bg-white rounded-lg shadow-md p-4">
    <h2 class="text-2xl font-bold text-blue-800">{{ $nom }}</h2>
    <p class="text-gray-600"><strong>Ciutat:</strong> {{ $ciutat }}</p>
    <p class="text-gray-600"><strong>Capacitat:</strong> {{ $capacitat }}</p>
    <p class="text-gray-600"><strong>Equip:</strong>
    @if ($equips->count())
        @foreach ($equips as $i => $equip)
            <span class="text-blue-800">{{ $equip['nom'] }}</span>
            @if ($i < $equips->count() - 1)
                <span class="text-gray-600">,</span>
            @endif
        @endforeach
    @else
        <span class="text-red-500">Sense equips assignats</span>
    @endif
    </p>
</div>

