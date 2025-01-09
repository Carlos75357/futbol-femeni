@extends('layouts.futbolFemeni')

@section('title', "Guia de Partits")

@section('content')
<div>
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Jornada {{ $partits->currentPage() }}</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($partits as $jornada)
    <div class="bg-white border border-gray-200 rounded-lg p-4 text-center shadow-md">
        <div class="flex justify-between items-center">
            <div class="flex flex-col items-center">
                <h2 class="text-2xl font-bold">{{ $jornada->equipLocal->nom }}</h2>
                <img src="{{ asset('storage/' . $jornada->equipLocal->escut) }}" alt="Escut de {{ $jornada->equipLocal->nom }}" class="h-9 w-9 object-cover rounded-full border-2 border-blue-800 mb-2">
            </div>
            <div class="flex flex-col items-center">
                <h2 class="text-2xl font-bold">{{ $jornada->equipVisitant->nom }}</h2>
                <img src="{{ asset('storage/' . $jornada->equipVisitant->escut) }}" alt="Escut de {{ $jornada->equipVisitant->nom }}" class="h-9 w-9 object-cover rounded-full border-2 border-blue-800 mb-2">
            </div>
        </div>
        <p class="text-4xl font-extrabold text-gray-900 mt-2 mb-0">
            {{ $jornada->gols_local }} - {{ $jornada->gols_visitant }}
        </p>
        <h2 class="text-xl text-gray-700 mt-0">{{ $jornada->data_partit }}</h2>
    </div>
    @endforeach
</div>


<div class="mt-4">
    {{ $partits->links() }}
</div>
@endsection
