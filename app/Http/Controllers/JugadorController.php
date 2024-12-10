<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;
use App\Models\Equip;

class JugadorController extends Controller
{
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equips = Equip::all();
        return view('jugadors.create' , compact('equips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'equip_id' => 'required|exists:equips,id',
            'posicio' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('jugadors', 'public');
            $validated['foto'] = $path;
        } else {
            unset($validated['foto']);
        }
    
        Jugador::create($validated);
    
        return redirect()->route('jugadors.index')->with('success', 'Jugador creat correctament.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Jugador $jugador)
    {
        return view('jugadors.show', compact('jugador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jugador $jugador)
    {
        $equips = Equip::all();
        return view('jugadors.edit', compact('jugador', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'equip_id' => 'required|exists:equips,id',
            'posicio' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

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
    public function destroy(string $id)
    {
        // Eliminar el jugador especificat
        $jugador = Jugador::findOrFail($id);

        // Si té una foto, eliminar-la del sistema
        if ($jugador->foto) {
            \Storage::disk('public')->delete($jugador->foto);
        }

        $jugador->delete();

        return redirect()->route('jugadors.index')->with('success', 'Jugador eliminat correctament.');
    }
}
