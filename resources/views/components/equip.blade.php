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
        <p class="text-sm text-gray-600"><strong>Descripcio IA:</strong> {{ $descripcio ?? 'No disponible' }}</p>
</p>
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
