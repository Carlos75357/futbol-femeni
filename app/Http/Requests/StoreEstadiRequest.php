<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Estadi;

class StoreEstadiRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->can('create', Estadi::class); 
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'capacitat' => 'required|integer|min:1',
            'ciutat' => 'required|string|max:255',
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