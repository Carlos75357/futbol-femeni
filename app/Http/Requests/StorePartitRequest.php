<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Partit;
use App\Models\User;

class StorePartitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equip_local_id' => 'required|exists:equips,id',
            'equip_visitant_id' => 'required|exists:equips,id',
            'data_partit' => 'required|date',
            'gols_local' => 'required|integer|min:0',
            'gols_visitant' => 'required|integer|min:0',
            'jornada' => 'required|integer|min:1',
            'arbitre_id' => 'required|exists:users,id',
        ];
    }

    public function messages() {
        return [
            'equip_local_id.required' => 'El camp "Equip local" es obligatori.',
            'equip_local_id.exists' => 'L\'equip local seleccionat no existeix.',
            'equip_visitant_id.required' => 'El camp "Equip visitant" es obligatori.',
            'equip_visitant_id.exists' => 'L\'equip visitant seleccionat no existeix.',
            'data_partit.required' => 'El camp "Data partit" es obligatori.',
            'data_partit.date' => 'El camp "Data partit" ha de ser una data vàlida.',
            'gols_local.required' => 'El camp "Goles local" es obligatori.',
            'gols_local.integer' => 'El camp "Goles local" ha de ser un nombre enter.',
            'gols_local.min' => 'El nombre de goles local no pot ser inferior a zero.',
            'gols_visitant.required' => 'El camp "Goles visitant" es obligatori.',
            'gols_visitant.integer' => 'El camp "Goles visitant" ha de ser un nombre enter.',
            'gols_visitant.min' => 'El nombre de goles visitant no pot ser inferior a zero.',
            'jornada.required' => 'El camp "Jornada" es obligatori.',
            'jornada.integer' => 'El camp "Jornada" ha de ser un nombre enter.',
            'jornada.min' => 'La jornada no pot ser inferior a 1.',
            'arbitre_id.required' => 'El camp "Arbitre" es obligatori.',
            'arbitre_id.exists' => 'L\'arbitre seleccionat no existeix.',
        ];
    }
}

