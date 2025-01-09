<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Partit;
use App\Models\User;

class StorePartitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'arbitre';
    }

    public function rules(): array
    {
        return [
            'gols_local' => 'required|integer|min:0',
            'gols_visitant' => 'required|integer|min:0',
        ];
    }

    public function messages() {
        return [
            'gols_local.required' => 'El camp "Goles local" es obligatori.',
            'gols_local.integer' => 'El camp "Goles local" ha de ser un nombre enter.',
            'gols_local.min' => 'El nombre de goles local no pot ser inferior a zero.',
            'gols_visitant.required' => 'El camp "Goles visitant" es obligatori.',
            'gols_visitant.integer' => 'El camp "Goles visitant" ha de ser un nombre enter.',
            'gols_visitant.min' => 'El nombre de goles visitant no pot ser inferior a zero.',
        ];
    }
}

