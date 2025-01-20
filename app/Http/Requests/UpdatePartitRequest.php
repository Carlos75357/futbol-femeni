<?php

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