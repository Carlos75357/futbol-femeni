<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Jugador;

class StoreJugadoraRequest extends FormRequest
{
    private bool $isAdmin = false;

    public function authorize(): bool
    {
        if ($this->user()) {
            $this->isAdmin = $this->user()->role === 'administrador';
            return $this->user()->can('create', Jugador::class);
        }

        return false; // Usuario no autenticado
    }

    public function rules(): array
    {
        return [
            'nom' => 'sometimes|required|string|max:255',
            'posicio' => ['sometimes', 'required', Rule::in(['Defensa', 'Centrocampista', 'Delantero', 'Portero'])],
            'equip_id' => [
                'required',
                'exists:equips,id',
                $this->isAdmin ? null : Rule::in([auth()->user()->equip_id])
            ],
            'data_naixement' => [
                'sometimes',
                'required',
                'date',
                'before:today',
                'before_or_equal:' . now()->subYears(16)->format('Y-m-d')
            ],
            'foto' => 'sometimes|nullable|image|mimes:png|max:2048',
            'dorsal' => ['sometimes', 'required', 'integer', 'min:1', 'max:99'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'El camp "Nom" és obligatori.',
            'nom.string' => 'El camp "Nom" ha de ser una cadena de text.',
            'nom.max' => 'El camp "Nom" no pot superar els 255 caracters.',
            'posicio.required' => 'El camp "Posició" és obligatori.',
            'posicio.in' => 'El valor del camp "Posició" no és vàlid.',
            'equip_id.required' => 'El camp "Equip" és obligatori.',
            'equip_id.exists' => 'L\'equip seleccionat no existeix.',
            'data_naixement.required' => 'El camp "Data de naixement" és obligatori.',
            'data_naixement.date' => 'El camp "Data de naixement" ha de ser una data vàlida.',
            'data_naixement.before' => 'El camp "Data de naixement" ha de ser anterior a la data actual.',
            'data_naixement.before_or_equal' => 'El camp "Data de naixement" ha de ser anterior o igual a fa 16 anys.',
            'foto.image' => 'El camp "Foto" ha de ser una imatge.',
            'foto.mimes' => 'El camp "Foto" ha de ser una imatge en format PNG.',
            'foto.max' => 'El camp "Foto" no pot superar els 2 MB.',
            'dorsal.required' => 'El camp "Dorsal" és obligatori.',
            'dorsal.integer' => 'El camp "Dorsal" ha de ser un número enter.',
            'dorsal.min' => 'El camp "Dorsal" ha de ser superior o igual a 1.',
            'dorsal.max' => 'El camp "Dorsal" ha de ser inferior o igual a 99.',
        ];
    }
}
