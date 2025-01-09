<!-- resources/views/livewire/classificacio.blade.php -->

<style>
    .dorat { border: 2px solid gold; box-shadow: inset 0 0 10px gold; }
    .blau { border: 2px solid blue; box-shadow: inset 0 0 10px blue; }
    .vermell { border: 2px solid red; box-shadow: inset 0 0 10px red; }
    .gris { border: 2px solid gray; box-shadow: inset 0 0 10px gray; }
    .naranja { border: 2px solid orange; box-shadow: inset 0 0 10px orange; }
</style>

<div>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300">Posició</th>
                <th class="py-2 px-4 border-b border-gray-300">Nom de l’equip</th>
                <th class="py-2 px-4 border-b border-gray-300">Total de punts</th>
                <th class="py-2 px-4 border-b border-gray-300">Partits jugats</th>
                <th class="py-2 px-4 border-b border-gray-300">Partits guanyats</th>
                <th class="py-2 px-4 border-b border-gray-300">Partits empatats</th>
                <th class="py-2 px-4 border-b border-gray-300">Partits perduts</th>
                <th class="py-2 px-4 border-b border-gray-300">Gols a favor</th>
                <th class="py-2 px-4 border-b border-gray-300">Gols en contra</th>
                <th class="py-2 px-4 border-b border-gray-300">Diferència de gols</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classificacio as $key => $equip)
            <tr @if($key === 0) class="dorat" @elseif($key >= 1 && $key <= 3) class="blau" @elseif($key <= 5 && $key >= 4) class="naranja" @elseif($key === 6) class="gris" @elseif($key >= 15) class="vermell" @else class="" @endif>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $key + 1 }}</td>
                <td class="py-2 px-4 border-b border-gray-300">{{ $equip['equip'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['puntos'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['partits_jugats'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['partits_guanyats'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['partits_empatats'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['partits_perduts'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['gols_a_favor'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['gols_en_contra'] }}</td>
                <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $equip['diferencia_gols'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>