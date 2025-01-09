<?php

namespace App\Livewire;

use App\Events\PartitActualizat;
use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Livewire\Component;
use App\Models\Equip;
use App\Models\Partit;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ClassificacioEquips extends Component
{
    public $classificacio;

    protected $listeners = [
        'PartitActualizat' => 'actualizarClassificacio', 
    ];

    public function mount()
    {
        $this->renderClassificacio();
    }

    public function render()
    {
        return view('livewire.classificacio-equips');
    }

    public function actualizarClassificacio() {
        $this->renderClassificacio();
        $this->render();
    }

    public function renderClassificacio()
    {
        // dd("renderClassificacio");
        $this->classificacio = Equip::with('partitsLocal', 'partitsVisitant')
            ->get()
            ->map(function ($equip) {
                $partitsJ = $this->calcularPartitsJugats($equip);
                $partitsG = $this->calcularPartitsGuanyats($equip);
                $partitsE = $this->calcularPartitsEmpatats($equip);
                $partitsP = $partitsJ - $partitsG - $partitsE;
                $golsAFavor = $this->calcularGolsAFavor($equip);
                $golsEnContra = $this->calcularGolsEnContra($equip);
                $diferenciaGols = $golsAFavor - $golsEnContra;

                return [
                    'equip' => $equip->nom,
                    'puntos' => $partitsG * 3 + $partitsE,
                    'partits_jugats' => $partitsJ,
                    'partits_guanyats' => $partitsG,
                    'partits_empatats' => $partitsE,
                    'partits_perduts' => $partitsP,
                    'gols_a_favor' => $golsAFavor,
                    'gols_en_contra' => $golsEnContra,
                    'diferencia_gols' => $diferenciaGols,
                ];
            })
            ->sortByDesc('puntos')
            ->values();
    }

    private function calcularPartitsJugats($equip)
    {
        return $equip->partitsLocal->whereNotNull('gols_local')->count()
            + $equip->partitsVisitant->whereNotNull('gols_visitant')->count();
    }

    private function calcularPartitsGuanyats($equip)
    {
        $localWins = $equip->partitsLocal->filter(function ($partit) {
            return $partit->gols_local !== null && $partit->gols_local > $partit->gols_visitant;
        })->count();

        $visitantWins = $equip->partitsVisitant->filter(function ($partit) {
            return $partit->gols_visitant !== null && $partit->gols_visitant > $partit->gols_local;
        })->count();

        return $localWins + $visitantWins;
    }

    private function calcularPartitsEmpatats($equip)
    {
        return $equip->partitsLocal->filter(function ($partit) {
            return $partit->gols_local !== null && $partit->gols_local === $partit->gols_visitant;
        })->count() +
            $equip->partitsVisitant->filter(function ($partit) {
                return $partit->gols_visitant !== null && $partit->gols_visitant === $partit->gols_local;
            })->count();
    }

    private function calcularGolsAFavor($equip)
    {
        return $equip->partitsLocal->sum('gols_local') + $equip->partitsVisitant->sum('gols_visitant');
    }

    private function calcularGolsEnContra($equip)
    {
        return $equip->partitsLocal->sum('gols_visitant') + $equip->partitsVisitant->sum('gols_local');
    }
}
