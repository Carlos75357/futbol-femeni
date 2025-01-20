<div class="equip border rounded-lg shadow-md p-6 bg-white max-w-lg mx-auto space-y-6">
    @if ($escut)
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $escut) }}" alt="Escut de {{ $nom }}" class="h-16 w-16 object-cover rounded-full border-2 border-blue-800">
            <h2 class="text-4xl font-bold text-blue-800">{{ $nom }}</h2>
        </div>
    @endif
    <div class="info space-y-2">
        <p class="text-lg text-gray-600"><strong>Estadi:</strong> {{ $estadi }}</p>
        <p class="text-lg text-gray-600"><strong>Títols:</strong> {{ $titols }}</p>
        <p class="text-sm text-gray-600"><strong>Edad Media:</strong> {{ $edadMedia }}</p>
    </div>

    <!-- Jugadores Section -->
    <div class="players">
        <h3 class="text-4xl font-semibold text-blue-800 mb-4 text-center">Jugadors</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($jugadors as $jugador)
                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('storage/' . $jugador['foto']) }}" alt="{{ $jugador['nom'] }}" class="h-20 w-20 object-cover rounded-full border-2 border-blue-800 mb-3">
                    <h4 class="text-gray-800 font-medium">{{ $jugador['nom'] }}</h4>
                    <p class="text-md text-gray-500">{{ $jugador['posicio'] }}</p>
                    <p class="text-md text-gray-500">Dorsal: {{ $jugador['dorsal'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Partidos Section -->
    <div class="matches">
        <h3 class="text-4xl font-semibold text-blue-800 mb-4 text-center">Partits</h3>

        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($partits as $partit)
                    <div class="p-4 bg-white border border-gray-200 rounded-md shadow-md text-center">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">{{ $partit->equipLocal->nom }}</h2>
                            <h2 class="text-lg font-bold text-gray-800">{{ $partit->equipVisitant->nom }}</h2>
                        </div>
                        <p class="text-3xl font-extrabold text-gray-900 my-2">
                            {{ $partit['gols_local'] }} - {{ $partit['gols_visitant'] }}
                        </p>
                        <p class="text-sm text-gray-600">{{ $partit['data_partit'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
