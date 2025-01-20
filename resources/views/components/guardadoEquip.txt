<div class="equip border rounded-lg shadow-md p-4 bg-white max-w-sm mx-auto space-y-4">
    @if ($escut)
        <div class="flex items-center">
            <img src="{{ asset('storage/' . $escut) }}" alt="Escut de {{ $nom }}" class="h-16 w-16 object-cover rounded-full border-2 border-blue-800">
            <h2 class="ml-4 text-xl font-bold text-blue-800">{{ $nom }}</h2>
        </div>
    @endif
    <p class="text-sm text-gray-600"><strong>Estadi:</strong> {{ $estadi }}</p>
    <p class="text-sm text-gray-600"><strong>Títols:</strong> {{ $titols }}</p>
    <div class="players mt-4">
        <h3 class="text-lg font-semibold text-blue-800 mb-2">Jugadors</h3>
        <ul class="space-y-2">
            @foreach($jugadors as $jugador)
                <li class="flex items-center p-2 bg-gray-100 rounded-md">
                    <img src="{{ asset('storage/' . $jugador['foto']) }}" alt="{{ $jugador['nom'] }}" class="h-8 w-8 object-cover rounded-full border-2 border-blue-800">
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-800">{{ $jugador['nom'] }}</h4>
                        <p class="text-gray-500">{{ $jugador['posicio'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="matches mt-4">
        <h3 class="text-lg font-semibold text-blue-800 mb-2">Partits</h3>
        <div class="local-matches">
            <h4 class="font-medium text-gray-800">Local</h4>
            <ul class="space-y-2">
                @foreach($partits as $partit)
                    @if($partit['equip_local_id'] === $id)
                        <li class="p-2 bg-gray-100 rounded-md">
                            {{ $partit['equip_local']['nom'] }} vs {{ $partit['equip_visitant']['nom'] }} ({{ $partit['resultat'] }})
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="visitor-matches mt-4">
            <h4 class="font-medium text-gray-800">Visitant</h4>
            <ul class="space-y-2">
                @foreach($partits as $partit)
                    @if($partit['equip_visitant_id'] === $id)
                        <li class="p-2 bg-gray-100 rounded-md">
                            {{ $partit['equip_local']['nom'] }} vs {{ $partit['equip_visitant']['nom'] }} ({{ $partit['resultat'] }})
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
