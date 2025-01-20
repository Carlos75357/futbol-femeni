<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadiRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->role === 'administrador';
    }

    public function rules(): array
    {
        return [
            'nom' => 'sometimes|required|string|max:255',
            'capacitat' => 'sometimes|required|integer|min:1',
            'ciutat' => 'sometimes|required|string|max:255',
        ];
    }

    public function messages() {
        return [
            'nom.required' => 'El camp "Nom" es obligatori.',
            'capacitat.required' => 'El camp "Capacitat" es obligatori.',
            'ciutat.required' => 'El camp "Ciutat" es obligatori.',
            'capacitat.integer' => 'El camp "Capacitat" ha de ser un nombre enter.',
            'capacitat.min' => 'La capacitat no pot ser inferior a 1.',
        ];
    }
}