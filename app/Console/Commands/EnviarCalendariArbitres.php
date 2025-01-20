<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Partit;
use App\Mail\CalendariArbitreMail;

class EnviarCalendariArbitres extends Command
{
    protected $signature = 'calendari:enviar';
    protected $description = 'Envia el calendari anual als arbitres';

    public function handle()
    {
        $arbitres = User::where('role', 'arbitre')->get(); // Obtén todos los árbitros

        // Filtra los partidos programados para el año actual para cada árbitro
        $arbitres->each(function ($arbitre) {
            $partits = Partit::where('arbitre_id', $arbitre->id)
                             ->whereYear('data_partit', Carbon::now()->year)
                             ->orderBy('data_partit', 'asc')
                             ->get();

            Mail::to($arbitre->email)->send(new CalendariArbitreMail($partits));
            $this->info($arbitre->name . ' ha rebut el calendari.');
        });

        $this->info('El calendari ha estat enviat correctament als arbitres.');
    }
}

