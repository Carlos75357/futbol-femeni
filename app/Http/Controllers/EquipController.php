<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Jugador;
use App\Models\Partit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Services\ChatGPTService;

class EquipController extends Controller
{
    use AuthorizesRequests;
    public function index() {
        $equips = Equip::all();
        $estadis = Estadi::all(); 
        $equips = Equip::paginate(10);
        return view('equips.index', compact('equips', 'estadis'));
    }
   
    public function show(Equip $equip) {

        $descripcio = ChatGPTService::getChatResponse('Dona una descripció del '.$equip->nom.' de Futbol Femení');
        return view('equips.show', compact('equip','descripcio'));
    }
    
   
    public function create() {
        $this->authorize('create', Equip::class);
        $estadis = Estadi::all(); 

        return view('equips.create', compact('estadis'));
    }

    public function store(StoreEquipRequest $request)
    {
        $this->authorize('create', Equip::class);
        $validated = $request->validated();
    
        if ($request->hasFile('escut')) {
            $path = $request->file('escut')->store('escuts', 'public');
            $validated['escut'] = $path;
        }
    
        Equip::create($validated);
    
        return redirect()->route('equips.index')->with('success', 'Equip creat correctament!');
    }
   
    public function edit(Equip $equip) {
        $this->authorize('update', $equip);
        $estadis = Estadi::all(); 
        return view('equips.edit', compact('equip', 'estadis'));
    }

    public function update(UpdateEquipRequest $request, $id)
    {
        $this->authorize('update', Equip::findOrFail($id));
        $validated = $request->validated();

        $equip = Equip::findOrFail($id);
    
        if ($request->hasFile('escut')) {
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut); // Esborra l'escut antic
            }
            $path = $request->file('escut')->store('escuts', 'public');
            $validated['escut'] = $path;
        }
    
        $equip->update($validated);
    
        return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament!');
    }
       
    public function destroy(Equip $equip)
    {
        $this->authorize('delete', $equip);
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }
        $equip->delete();
        return redirect()->route('equips.index')->with('success', 'Equip esborrat correctament!');
    }
}
