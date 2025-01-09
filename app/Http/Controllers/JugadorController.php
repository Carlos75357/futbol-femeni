<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;
use App\Models\Equip;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JugadorController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadors = Jugador::all();
        $jugadors = Jugador::paginate(11);
        return view('jugadors.index', compact('jugadors'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Jugador $jugador)
    {
        return view('jugadors.show', compact('jugador'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Jugador::class);
        // $equips = auth()->user()->equip_id ? [Equip::find(auth()->user()->equip_id)] : Equip::all();
        $equips = Equip::all();
        return view('jugadors.create', compact('equips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJugadoraRequest $request)
    {
        $this->authorize('create', Jugador::class);

        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('jugadors', 'public');
            $validated['foto'] = $path;
        }
    
        Jugador::create($validated);
    
        return redirect()->route('jugadors.index')->with('success', 'Jugador creat correctament.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jugador $jugador)
    {
        $this->authorize('update', $jugador);
        $equips = Equip::all();
        return view('jugadors.edit', compact('jugador', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJugadoraRequest $request, $id)
    {
        $this->authorize('update', Jugador::findOrFail($id));

        $validated = $request->validated();
        
        $jugador = Jugador::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($jugador->foto) {
                \Storage::disk('public')->delete($jugador->foto);
            }
            $path = $request->file('foto')->store('jugadors', 'public');
            $validated['foto'] = $path;
        }

        $jugador->update($validated);

        return redirect()->route('jugadors.index')->with('success', 'Jugador actualitzat correctament.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugador $jugador)
    {
        $this->authorize('delete', $jugador);
        // Si té una foto, eliminar-la del sistema
        if ($jugador->foto) {
            \Storage::disk('public')->delete($jugador->foto);
        }

        $jugador->delete();

        return redirect()->route('jugadors.index')->with('success', 'Jugador eliminat correctament.');
    }
}
