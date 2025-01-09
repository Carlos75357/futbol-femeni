@extends('layouts.futbolFemeni')

@section('title', "Guia de Jugadors")

@section('content')
<main class="container mx-auto px-6 py-8">
    <div class="text-center bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-4xl font-bold text-blue-800 mb-6">Benvinguts a la Guia de Futbol Femení</h2>
        <p class="text-gray-600 mb-8">
            Explora equips, estadis i jugadors destacats del món del futbol femení.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="/equips" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Veure Equips
            </a>
            <a href="/estadis" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Veure Estadis
            </a>
            <a href="/jugadors" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Veure Jugadors
            </a>
            <a href="/partits" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Veure Partits
            </a>
        </div>
    </div>
</main>
@endsection