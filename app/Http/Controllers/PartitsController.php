<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partit;
use App\Models\Equip;

class PartitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partits = Partit::all();
        $partits = Partit::paginate(10);
        $equips = Equip::all();
        return view('partits.index', compact('partits', 'equips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equips = Equip::all();
        return view('partits.create', compact('equips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar les dades d'entrada
        $validated = $request->validate([
            'equip_local_id' => 'required|exists:equips,id',
            'equip_visitant_id' => 'required|exists:equips,id',
            'data_partit' => 'required|date',
            'resultat' => 'nullable|string',
        ]);

        $gols = explode('-', $validated['resultat']);
        $validated['gols_local'] = $gols[0] ?? 0;
        $validated['gols_visitant'] = $gols[1] ?? 0;

        Partit::create($validated);

        return redirect()->route('partits.index')->with('success', 'Partit creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partit $partit)
    {
        $local = Equip::findOrFail($partit->equip_local_id);
        $visitant = Equip::findOrFail($partit->equip_visitant_id);
        return view('partits.show', compact('partit', 'local', 'visitant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partit $partit)
    {
        $equips = Equip::all();
        return view('partits.edit', compact('partit', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar les dades d'entrada
        $validated = $request->validate([
            'equip_local_id' => 'required|exists:equips,id',
            'equip_visitant_id' => 'required|exists:equips,id',
            'data_partit' => 'required|date',
            'resultat' => 'nullable|string',
        ]);

        $gols = explode('-', $validated['resultat']);
        $validated['gols_local'] = $gols[0] ?? 0;
        $validated['gols_visitant'] = $gols[1] ?? 0;

        $partit = Partit::findOrFail($id);
        $partit->update($validated);

        return redirect()->route('partits.index')->with('success', 'Partit actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar el partit especificat
        $partit = Partit::findOrFail($id);
        $partit->delete();

        return redirect()->route('partits.index')->with('success', 'Partit eliminat correctament.');
    }
}
