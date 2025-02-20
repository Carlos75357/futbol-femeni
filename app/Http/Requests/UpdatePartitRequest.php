<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use App\Models\Partit;

// class UpdatePartitRequest extends FormRequest
// {
//     public function authorize(): bool
//     {
//         return $this->user()->can('update', Partit::findOrFail($this->route('partit')));
//     }

//     public function rules(): array
//     {
//         return [
//             'equip_local_id' => 'required|integer|exists:equips,id',
//             'equip_visitant_id' => 'required|integer|exists:equips,id',
//             'data_partit' => 'required|date',
//             'gols_local' => 'required|integer|min:0',
//             'gols_visitant' => 'required|integer|min:0',
//             'arbitre_id' => 'required|integer|exists:users,id',
//             'jornada' => 'required|integer|min:1',
//         ];
//     }
//      public function messages(): array
//     {
//         return [
//             'equip_local_id.required' => 'El camp "Equip local" és obligatori.',
//             'equip_local_id.integer' => 'El camp "Equip local" ha de ser un nombre enter.',
//             'equip_local_id.exists' => 'El camp "Equip local" no existeix.',
//             'equip_visitant_id.required' => 'El camp "Equip visitant" és obligatori.',
//             'equip_visitant_id.integer' => 'El camp "Equip visitant" ha de ser un nombre enter.',
//             'equip_visitant_id.exists' => 'El camp "Equip visitant" no existeix.',
//             'data_partit.required' => 'El camp "Data del partit" és obligatori.',
//             'data_partit.date' => 'El camp "Data del partit" ha de ser una data.',
//             'gols_local.required' => 'El camp "Gols local" és obligatori.',
//             'gols_local.integer' => 'El camp "Gols local" ha de ser un nombre enter.',
//             'gols_local.min' => 'El nombre de gols local no pot ser inferior a zero.',
//             'gols_visitant.required' => 'El camp "Gols visitant" és obligatori.',
//             'gols_visitant.integer' => 'El camp "Gols visitant" ha de ser un nombre enter.',
//             'gols_visitant.min' => 'El nombre de gols visitant no pot ser inferior a zero.',
//             'arbitre_id.required' => 'El camp "Arbitre" és obligatori.',
//             'arbitre_id.integer' => 'El camp "Arbitre" ha de ser un nombre enter.',
//             'arbitre_id.exists' => 'El camp "Arbitre" no existeix.',
//             'jornada.required' => 'El camp "Jornada" és obligatori.',
//             'jornada.integer' => 'El camp "Jornada" ha de ser un nombre enter.',
//             'jornada.min' => 'La jornada no pot ser inferior a 1.',
//             'resultat.required' => 'El camp "Resultat" és obligatori.',
//             'resultat.regex' => 'El camp "Resultat" ha de tenir el format "X-Y", on X i Y són nombres enters.',
//         ];
//     }
// }

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Partit;

class UpdatePartitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', Partit::findOrFail($this->route('partit')));
    }

    public function rules(): array
    {
        return [
            'resultat' => 'sometimes|required|regex:/^\d{1,2}-\d{1,2}$/',
        ];
    }

    public function messages() {
        return [
            'resultat.required' => 'El camp "Resultat" es obligatori.',
            'resultat.regex' => 'El camp "Resultat" ha de tenir el format "X-Y", on X i Y s n nombres enters.',
        ];
    }
}