<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Jugador;

class StoreJugadoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        $this->isAdmin = $this->user()->role === 'administrador';
        return $this->user()->can('create', Jugador::class);
    }

    public function rules(): array
    {
        return [
            'nom' => 'sometimes|required|string|max:255',
            'posicio' => ['sometimes', 'required', Rule::in(['Defensa', 'Centrocampista', 'Delantero', 'Portero'])],
            'equip_id' => $this->isAdmin ? 'required|exists:equips,id' : 'required|exists:equips,id|in:' . auth()->user()->equip_id,
            'data_naixement' => ['sometimes', 'required', 'date', 'before:today', 'before_or_equal:' . now()->subYears(16)->format('Y-m-d')],
            'foto' => 'sometimes|nullable|image|mimes:png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'El camp "Nom" es obligatori.',
            'nom.string' => 'El camp "Nom" ha de ser una cadena de text.',
            'nom.max' => 'El camp "Nom" no pot superar els 255 caracters.',
            'posició.required' => 'El camp "Posició" es obligatori.',
            'posició.in' => 'El camp "Posició" no pot ser una cadena de text.',
            'equip_id.required' => 'El camp "Equip" es obligatori.',
            'equip_id.exists' => 'L\'equip seleccionat no existeix.',
            'data_naixement.required' => 'El camp "Data de naixement" es obligatori.',
            'data_naixement.date' => 'El camp "Data de naixement" ha de ser una data.',
            'data_naixement.before' => 'El camp "Data de naixement" ha de ser anterior a la data actual.',
            'data_naixement.before_or_equal' => 'El camp "Data de naixement" ha de ser anterior o igual a la data actual.',
            'foto.image' => 'El camp "Foto" ha de ser una imatge.',
            'foto.mimes' => 'El camp "Foto" ha de ser una imatge en format PNG.',
            'foto.max' => 'El camp "Foto" no pot superar els 2 MB.',
        ];
    }
}
