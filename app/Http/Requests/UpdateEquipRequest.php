<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreEquipRequest;
use App\Models\Equip;

class UpdateEquipRequest extends FormRequest
{
    public function authorize()
    {
        // dd($this->user()->can('update', $this->route('equip')));

        // dd($this->user()->can('update', Equip::findOrFail($this->equip)));
        return $this->user()->can('update', Equip::findOrFail($this->equip)) || $this->user()->role === 'administrador';
    }

    public function rules()
    {
        $equipId = $this->route('equip'); 

        return [
            'nom' => "required|unique:equips,nom,{$equipId}",
            'titols' => 'integer|min:0',
            'estadi_id' => 'required|exists:estadis,id',
            'escut' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    } 
    public function messages() {
        return [
            'nom.required' => 'El camp "Nom" es obligatori.',
            'nom.unique' => 'Aquest nom ja està en ús. Si us plau, tria un altre.',
            'titols.integer' => 'El camp "Titol" ha de ser un número enter.',
            'titols.min' => 'El nombre de títols no pot ser inferior a zero.',
            'estadi_id.required' => 'El camp "Estadi" es obligatori.',
            'estadi_id.exists' => 'L\'estadi seleccionat no és vàlid.',
            'escut.image' => 'El camp "Escut" ha de ser una imatge.',
            'escut.mimes' => 'El camp "Escut" només accepta formats: jpeg, png, jpg.',
            'escut.max' => 'La mida de l\'escut no pot superar els 2 MB.',
        ];
    }
}
